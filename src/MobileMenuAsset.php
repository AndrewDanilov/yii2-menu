<?php
namespace andrewdanilov\menu;

use yii\web\AssetBundle;

class MobileMenuAsset extends AssetBundle
{
	public $sourcePath = '@andrewdanilov/menu/web';
	public $css = [
		'css/jquery.mmenu.all.css',
		'css/mobile-menu.css',
	];
	public $js = [
		'js/jquery.mmenu.all.js',
		'js/mobile-menu.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];
}