Menu tools
===================
Various tools for constructing menus, breadcrumbs, etc.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-menu "~1.0.0"
```

or add

```
"andrewdanilov/yii2-menu": "~1.0.0"
```

to the require section of your `composer.json` file.


Usage
-----

__Breadcrumbs__

Widget let you create breadcrumbs in simialar way as the default yii breadcrumbs widget, but
with help of template files. You can define templates separetely for wrapper, link item and for
active (last) breadcrumb item.

```php
<?= andrewdanilov\menu\Breadcrumbs::widget([
	'templateWrapper' => '@frontend/views/site/breadcrumbs/wrapper',
	'templateItem' => '@frontend/views/site/breadcrumbs/item',
	'templateActiveItem' => '@frontend/views/site/breadcrumbs/active-item',
	'showHome' => false, // default true
	'homeLabel' => 'Main',
	'homeUrl' => ['site/index'],
	'items' => [
		['label' => 'Category', 'url' => ['site/category']],
		['label' => 'Subcategory', 'url' => ['site/subcategory']],
		['label' => 'Product #1'], // or short ['Product #1']
	],
]) ?>
```

__Menu__

```php
<?= andrewdanilov\menu\Menu::widget([
	'templateWrapper' => '@frontend/views/site/menu/wrapper',
	'templateParentItem' => '@frontend/views/site/menu/parent-item',
	'templateItem' => '@frontend/views/site/menu/item',
	'templateActiveItem' => '@frontend/views/site/menu/active-item',
	'items' => [
		[
			'label' => 'Menu item 1',
			'items' => [
				['label' => 'Menu subitem 1', 'url' => ['site/action1'], 'target' => '_blank'],
				['label' => 'Menu subitem 2', 'url' => ['site/action2']],
			],
		],
		[
			'label' => 'Menu item 2',
			'items' => [
				['label' => 'Menu subitem 3', 'url' => ['site/action3']],
				['label' => 'Menu subitem 4', 'url' => ['site/action4']],
			],
		],
	],
]) ?>
```

__Mobile menu__

```php
<?= andrewdanilov\menu\MobileMenu::widget([
	'templateWrapper' => '@frontend/views/site/menu/wrapper',
	'templateParentItem' => '@frontend/views/site/menu/parent-item',
	'templateItem' => '@frontend/views/site/menu/item',
	'templateActiveItem' => '@frontend/views/site/menu/active-item',
	'templateButton' => '@frontend/views/site/menu/button',
	'buttonLabel' => 'Menu',
	'items' => [
		[
			'label' => 'Menu item 1',
			'items' => [
				['label' => 'Menu subitem 1', 'url' => ['site/action1'], 'target' => '_blank'],
				['label' => 'Menu subitem 2', 'url' => ['site/action2']],
			],
		],
		[
			'label' => 'Menu item 2',
			'items' => [
				['label' => 'Menu subitem 3', 'url' => ['site/action3']],
				['label' => 'Menu subitem 4', 'url' => ['site/action4']],
			],
		],
		['label' => 'Menu item 3', 'url' => ['site/action3'], 'target' => '_blank'],
		['label' => 'Menu item 4', 'url' => ['site/action4']],
	],
]) ?>
```
