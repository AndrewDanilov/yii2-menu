<?php

namespace andrewdanilov\adminpanel;

use yii\web\AssetBundle;

class MobileMenuAsset extends AssetBundle
{
	public $sourcePath = '@vendor/andrewdanilov/yii2-menu/src/web';
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