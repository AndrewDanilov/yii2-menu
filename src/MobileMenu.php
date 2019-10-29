<?php
namespace andrewdanilov\menu;

/**
 * MobileMenu
 * Use:
 *  <?= andrewdanilov\menu\MobileMenu::widget([
 *      'templateWrapper' => '@frontend/views/site/menu/wrapper',
 *      'templateParentItem' => '@frontend/views/site/menu/parent-item',
 *      'templateItem' => '@frontend/views/site/menu/item',
 *      'templateActiveItem' => '@frontend/views/site/menu/active-item',
 *      'templateButton' => '@frontend/views/site/menu/button',
 *      'buttonLabel' => 'Menu',
 *      'items' => [
 *          [
 *  			'label' => 'Menu item 1',
 *  			'items' => [
 *  				['label' => 'Menu subitem 1', 'url' => ['site/action1'], 'target' => '_blank'],
 *  				['label' => 'Menu subitem 2', 'url' => ['site/action2']],
 *  			],
 *  		],
 *  		[
 *  			'label' => 'Menu item 2',
 *  			'items' => [
 *  				['label' => 'Menu subitem 3', 'url' => ['site/action3']],
 *  				['label' => 'Menu subitem 4', 'url' => ['site/action4']],
 *  			],
 *  		],
 *  	],
 *  ]) ?>
 */
class MobileMenu extends Menu
{
	public $templateWrapper = '@andrewdanilov/menu/views/mobile-menu/wrapper';
	public $templateParentItem = '@andrewdanilov/menu/views/mobile-menu/parent-item';
	public $templateItem = '@andrewdanilov/menu/views/mobile-menu/item';
	public $templateActiveItem = '@andrewdanilov/menu/views/mobile-menu/active-item';
	public $templateButton = '@andrewdanilov/menu/views/mobile-menu/button';
	public $buttonLabel = '';
	public $items = [];

	public function run()
	{
		MobileMenuAsset::register($this->getView());

		$menu = parent::run();
		$menu = $this->render($this->templateButton, ['label' => $this->buttonLabel]) . $menu;

		return $menu;
	}
}