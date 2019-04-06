<?php

/* @var $this \yii\web\View */
/* @var $label string */
/* @var $url string|array */

use yii\helpers\Url;

?>
<a class="breadcrumb-item" href="<?= Url::to($url) ?>"><?= $label ?></a>