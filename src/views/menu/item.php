<?php

/* @var $this \yii\web\View */
/* @var $label string */
/* @var $url string|array */

use yii\helpers\Url;

?>

<a href="<?= Url::to($url) ?>" <?php if ($target) { ?>target="<?= $target ?>"<?php } ?>><?= $label ?></a>