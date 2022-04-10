Menu tools
===================
Various tools for constructing menus, mobile menus, etc.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-menu "~2.0.0"
```

or add

```
"andrewdanilov/yii2-menu": "~2.0.0"
```

to the `require` section of your `composer.json` file.

Changes
-----

Breadcrumbs widget in version 2.0.0 was removed and became a standalone extension [yii2-breadcrumbs](https://github.com/AndrewDanilov/yii2-breadcrumbs)

Usage
-----

If you want to use your own templates for menus, copy `yii2-menu/src/views` folder contents to your own location, for i.e. to `frontend/views/site/_blocks/`
and fill properties `templateWrapper`, `templateParentItem`, `templateItem`, `templateActiveItem` and `templateButton` to your path values (see examples below). 

__Menu__

```php
<?= andrewdanilov\menu\Menu::widget([
    'templateWrapper' => '@frontend/views/site/_blocks/menu/wrapper',
    'templateParentItem' => '@frontend/views/site/_blocks/menu/parent-item',
    'templateItem' => '@frontend/views/site/_blocks/menu/item',
    'templateActiveItem' => '@frontend/views/site/_blocks/menu/active-item',
    'wrapperId' => 'my_menu', // optional, default is 'menu'
    'items' => [
        [
            'label' => 'Menu item 1', // required
            'items' => [ // optional
                [
                    'label' => 'Menu subitem 1', // required
                    'url' => ['site/action1'], // required for single menu items
                    'target' => '_blank', // optional
                ],
                ['label' => 'Menu subitem 2', 'url' => ['site/action2']],
            ],
        ],
        [
            'label' => 'Menu item 2',
            'url' => ['site/action3'], // optional for items has submenu
            'items' => [
                ['label' => 'Menu subitem 3', 'url' => ['site/action4']],
                ['label' => 'Menu subitem 4', 'url' => ['site/action5']],
            ],
        ],
        [
            'label' => 'Menu item 3',
            'url' => ['site/action6'],
            'target' => '_blank',
        ],
    ],
]) ?>
```

__Mobile menu__

```php
<?= andrewdanilov\menu\MobileMenu::widget([
    'templateWrapper' => '@frontend/views/site/_blocks/mobile-menu/wrapper',
    'templateParentItem' => '@frontend/views/site/_blocks/mobile-menu/parent-item',
    'templateItem' => '@frontend/views/site/_blocks/mobile-menu/item',
    'templateActiveItem' => '@frontend/views/site/_blocks/mobile-menu/active-item',
    'templateButton' => '@frontend/views/site/_blocks/mobile-menu/button',
    'buttonLabel' => 'Menu', // optional, default is ''
    'wrapperId' => 'my_mobile_menu', // optional, default is 'mobile_menu'
    'showNavbar' => true, // optional, default is false
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
