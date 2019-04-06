<?php

namespace andrewdanilov\menu;

use Yii;
use yii\base\Widget;

class Menu extends Widget
{
	public $templateWrapper = '@vendor/andrewdanilov/yii2-menu/src/views/menu/wrapper';
	public $templateParentItem = '@vendor/andrewdanilov/yii2-menu/src/views/menu/parent-item';
	public $templateItem = '@vendor/andrewdanilov/yii2-menu/src/views/menu/item';
	public $templateActiveItem = '@vendor/andrewdanilov/yii2-menu/src/views/menu/active-item';
	public $items = [];

	public $route;
	public $params;

	private $noDefaultRoute;
	private $noDefaultAction;

	public function run()
	{
		if ($this->route === null && Yii::$app->controller !== null) {
			$this->route = Yii::$app->controller->getRoute();
		}
		if ($this->params === null) {
			$this->params = Yii::$app->request->getQueryParams();
		}
		$posDefaultAction = strpos($this->route, Yii::$app->controller->defaultAction);
		if ($posDefaultAction) {
			$this->noDefaultAction = rtrim(substr($this->route, 0, $posDefaultAction), '/');
		} else {
			$this->noDefaultAction = false;
		}
		$posDefaultRoute = strpos($this->route, Yii::$app->controller->module->defaultRoute);
		if ($posDefaultRoute) {
			$this->noDefaultRoute = rtrim(substr($this->route, 0, $posDefaultRoute), '/');
		} else {
			$this->noDefaultRoute = false;
		}

		$parent_items = [];
		foreach ($this->items as $parent_item) {
			$items = [];
			foreach ($parent_item['items'] as $item) {
				if (!isset($item['target'])) {
					$item['target'] = null;
				}
				if ($this->isItemActive($item)) {
					$items[] = $this->render($this->templateActiveItem, ['url' => $item['url'], 'label' => $item['label'], 'target' => $item['target']]);
				} else {
					$items[] = $this->render($this->templateItem, ['url' => $item['url'], 'label' => $item['label'], 'target' => $item['target']]);
				}
			}
			$parent_items[] = $this->render($this->templateParentItem, ['label' => $parent_item['label'], 'content' => implode('', $items)]);
		}
		return $this->render($this->templateWrapper, ['content' => implode('', $parent_items)]);
	}

	/**
	 * Checks whether a menu item is active.
	 * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
	 * When the `url` option of a menu item is specified in terms of an array, its first element is treated
	 * as the route for the item and the rest of the elements are the associated parameters.
	 * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
	 * be considered active.
	 * @param array $item the menu item to be checked
	 * @return boolean whether the menu item is active
	 */
	protected function isItemActive($item)
	{
		if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
			$route = $item['url'][0];
			if (isset($route[0]) && $route[0] !== '/' && Yii::$app->controller) {
				$route = ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
			}
			$route = ltrim($route, '/');
			if ($route != $this->route && $route !== $this->noDefaultRoute && $route !== $this->noDefaultAction) {
				return false;
			}
			unset($item['url']['#']);
			if (count($item['url']) > 1) {
				foreach (array_splice($item['url'], 1) as $name => $value) {
					if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
						return false;
					}
				}
			}
			return true;
		}
		return false;
	}
}