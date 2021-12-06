<?php

/* @var $this View */
/* @var $label string */
/* @var $url string|array */
/* @var $target string */

use yii\helpers\Url;
use yii\web\View;

?>

<li>
	<a href="<?= Url::to($url) ?>" <?php if ($target) { ?>target="<?= $target ?>"<?php } ?>><?= $label ?></a>
</li>