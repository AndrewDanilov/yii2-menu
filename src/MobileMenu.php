<?php
namespace andrewdanilov\menu;

/**
 * MobileMenu
 *
 * @see https://github.com/AndrewDanilov/yii2-menu
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