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
	public $wrapperId = 'mobile_menu';
	public $showNavbar = false;
	public $items = [];

	public function run()
	{
		$view = $this->getView();
		MobileMenuAsset::register($this->getView());

		if ($this->wrapperId) {
			$view->registerJs('andrewdanilov.mobileMenu.wrapperId = "' . $this->wrapperId . '";');
		}
		if ($this->showNavbar) {
			$view->registerJs('andrewdanilov.mobileMenu.showNavbar = true;');
		}
		$view->registerJs('andrewdanilov.mobileMenu.init();');

		$menu = parent::run();
		return $this->render($this->templateButton, [
			'wrapperId' => $this->wrapperId,
			'label' => $this->buttonLabel,
		]) . $menu;
	}
}