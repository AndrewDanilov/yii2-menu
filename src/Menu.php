<?php
namespace andrewdanilov\menu;

use Yii;
use yii\base\Widget;

/**
 * Menu
 *
 * @see https://github.com/AndrewDanilov/yii2-menu
 */
class Menu extends Widget
{
	public $templateWrapper = '@andrewdanilov/menu/views/menu/wrapper';
	public $templateParentItem = '@andrewdanilov/menu/views/menu/parent-item';
	public $templateItem = '@andrewdanilov/menu/views/menu/item';
	public $templateActiveItem = '@andrewdanilov/menu/views/menu/active-item';
	public $wrapperId = 'menu';
	public $items = [];

	public function run()
	{
		$parent_items = [];
		foreach ($this->items as $parent_item) {
			if (isset($parent_item['items'])) {
				$items = [];
				foreach ($parent_item['items'] as $item) {
					if ($this->isItemActive($item)) {
						$templateItem = $this->templateActiveItem;
					} else {
						$templateItem = $this->templateItem;
					}
					if (!isset($item['target'])) {
						$item['target'] = null;
					}
					$items[] = $this->render($templateItem, [
						'label' => $item['label'],
						'url' => $item['url'],
						'target' => $item['target'],
					]);
				}
				if (!isset($parent_item['url'])) {
					$parent_item['url'] = null;
				}
				if (!isset($parent_item['target'])) {
					$parent_item['target'] = null;
				}
				$parent_items[] = $this->render($this->templateParentItem, [
					'label' => $parent_item['label'],
					'url' => $parent_item['url'],
					'target' => $parent_item['target'],
					'content' => implode('', $items),
				]);
			} else {
				if ($this->isItemActive($parent_item)) {
					$templateItem = $this->templateActiveItem;
				} else {
					$templateItem = $this->templateItem;
				}
				if (!isset($parent_item['target'])) {
					$parent_item['target'] = null;
				}
				$parent_items[] = $this->render($templateItem, [
					'label' => $parent_item['label'],
					'url' => $parent_item['url'],
					'target' => $parent_item['target'],
				]);
			}
		}
		return $this->render($this->templateWrapper, [
			'wrapperId' => $this->wrapperId,
			'content' => implode('', $parent_items),
		]);
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
		if (isset($item['url'])) {
			if (is_array($item['url']) && count($item['url']) == 1 && reset($item['url']) == '/') {
				$item['url'] = '/';
			}
			if (is_array($item['url'])) {
				if (!isset($item['url'][0])) {
					return false;
				}
				$currentRoute = Yii::$app->controller->getRoute();
				$currentParams = Yii::$app->request->getQueryParams();

				$posDefaultAction = strpos($currentRoute, Yii::$app->controller->defaultAction);
				if ($posDefaultAction) {
					$noDefaultAction = rtrim(substr($currentRoute, 0, $posDefaultAction), '/');
				} else {
					$noDefaultAction = false;
				}
				$posDefaultRoute = strpos($currentRoute, Yii::$app->controller->module->defaultRoute);
				if ($posDefaultRoute) {
					$noDefaultRoute = rtrim(substr($currentRoute, 0, $posDefaultRoute), '/');
				} else {
					$noDefaultRoute = false;
				}

				$route = $item['url'][0];
				if (isset($route[0]) && $route[0] !== '/' && Yii::$app->controller) {
					$route = ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
				}
				$route = ltrim($route, '/');
				if ($route != $currentRoute && $route !== $noDefaultRoute && $route !== $noDefaultAction) {
					return false;
				}
				unset($item['url']['#']);
				if (count($item['url']) > 1) {
					foreach (array_splice($item['url'], 1) as $name => $value) {
						if ($value !== null && (!isset($currentParams[$name]) || $currentParams[$name] != $value)) {
							return false;
						}
					}
				}
				return true;
			} elseif (is_string($item['url'])) {
				if (strpos($item['url'], $_SERVER['HTTP_HOST']) !== false) {
					$url_parts = explode($_SERVER['HTTP_HOST'], $item['url']);
					$item['url'] = $url_parts[1];
				}
				if (!$item['url'] || $item['url'] === '/') {
					if (Yii::$app->request->url === '/') {
						return true;
					}
					return false;
				}
				if (strpos(Yii::$app->request->url, $item['url']) === 0) {
					return true;
				}
			}
		}
		return false;
	}
}