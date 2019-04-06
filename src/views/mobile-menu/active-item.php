<?php

/* @var $this \yii\web\View */
/* @var $label string */
/* @var $url string|array */
/* @var $target string */

use yii\helpers\Url;

?>
<li>
	<a href="<?= Url::to($url) ?>" class="active" <?php if ($target) { ?>target="<?= $target ?>"<?php } ?>><?= $label ?></a>
</li>