<?php

namespace andrewdanilov\menu;

/**
 * Обертка для виджета хлебных крошек.
 * Позволяет задать класс для всех ссылок в хлебных крошках.
 * Использование:
 *	<?= Breadcrumbs::widget([
 *		'links' => $this->params['breadcrumbs'] ?? [],
 *		'link_class' => 'breadcrumb-item',
 *		'itemTemplate' => '<li>{link}</li>',
 *		'activeItemTemplate' => '<li>{link}</li>',
 *		'homeLink' => ['label' => 'Главная', 'url' => ['site/index']],
 *      // Отключить ссылку на главную
 *		// 'homeLink' => false,
 *		'tag' => 'ul',
 *		'options' => [
 *          'class' => 'breadcrumbs',
 *      ],
 *	]) ?>
 *
 * Class Breadcrumbs
 * @package frontend\components
 */

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
	public $link_class;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		if (!isset($this->itemTemplate)) {
			$this->itemTemplate = '{link}<div class="breadcrumb-divider"></div>';
		}
		if (!isset($this->activeItemTemplate)) {
			$this->activeItemTemplate = '<div class="breadcrumb-item">{link}</div>';
		}
		if (!isset($this->homeLink)) {
			$this->homeLink = false;
		}
		if (!isset($this->tag)) {
			$this->tag = 'div';
		}
		if (!isset($this->options['class'])) {
			$this->options['class'] = 'breadcrumbs';
		}
		if (!isset($this->link_class)) {
			$this->link_class = 'breadcrumb-item';
		}
		parent::init();
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		if (empty($this->links)) {
			return '';
		}
		if (is_array($this->homeLink) && isset($this->homeLink['url'])) {
			$this->homeLink['class'] = $this->link_class;
		}
		foreach ($this->links as &$link) {
			if (is_array($link) && isset($link['url'])) {
				$link['class'] = $this->link_class;
			}
		}
		unset($link);

		// если крошка одна или их нет, то не выводим ничего
		if (!$this->homeLink && count($this->links) < 2 || count($this->links) < 1) {
			return '';
		}

		// удаляем ссылку у последнего элемента крошек (если есть)
		$last_link = array_pop($this->links);
		if (isset($last_link['url'])) {
			unset($last_link['url']);
		}
		array_push($this->links, $last_link);

		return parent::run();
	}
}