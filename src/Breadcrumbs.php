<?php

namespace andrewdanilov\menu;

use yii\base\Widget;

/**
 * Breadcrumbs
 *
 * Use:
 *  <?= Breadcrumbs::widget([
 *		'templateWrapper' => '@frontend/views/site/breadcrumbs/wrapper',
 *		'templateItem' => '@frontend/views/site/breadcrumbs/item',
 *		'templateActiveItem' => '@frontend/views/site/breadcrumbs/active-item',
 *		'showHome' => true, // default fasle
 *		'homeLabel' => 'Main',
 *		'homeUrl' => ['site/index'],
 *		'items' => [
 *          ['label' => 'Category', 'url' => ['site/category']],
 *          ['label' => 'Subcategory', 'url' => ['site/subcategory']],
 *          ['label' => 'Product #1'], // or short ['Product #1']
 *      ],
 *  ]) ?>
 *
 * All parameters are optional.
 */

class Breadcrumbs extends Widget
{
	public $templateWrapper = '@vendor/andrewdanilov/yii2-menu/src/views/breadcrumbs/wrapper';
	public $templateItem = '@vendor/andrewdanilov/yii2-menu/src/views/breadcrumbs/item';
	public $templateActiveItem = '@vendor/andrewdanilov/yii2-menu/src/views/breadcrumbs/active-item';
	public $showHome = false;
	public $homeLabel = 'Главная';
	public $homeUrl = ['/'];
	public $items = [];

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		if ($this->showHome) {
			array_unshift($this->items, ['label' => $this->homeLabel, 'url' => $this->homeUrl]);
		}
		if (count($this->items) < 2) {
			return '';
		}

		// convert last element short notation to normal
		// and remove url from it, if it has one.
		$lastItem = array_pop($this->items);
		if (is_string($lastItem)) {
			$lastItem = ['label' => $lastItem];
		}
		unset($lastItem['url']);
		array_push($this->items, $lastItem);

		$out = [];
		foreach ($this->items as $item) {
			if (is_array($item) && isset($item['label'])) {
				if (isset($item['url'])) {
					$out[] = $this->render($this->templateItem, $item);
				} else {
					$out[] = $this->render($this->templateActiveItem, $item);
				}
			}
		}

		return $this->render($this->templateWrapper, ['content' => implode('', $out)]);
	}
}