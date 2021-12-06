<?php

/* @var $this View */
/* @var $label string */
/* @var $url string|array */
/* @var $target string */
/* @var $content string */

use yii\helpers\Url;
use yii\web\View;

?>

<li>
	<?php if ($url) { ?>
		<a href="<?= Url::to($url) ?>" <?php if ($target) { ?>target="<?= $target ?>"<?php } ?>><?= $label ?></a>
	<?php } else { ?>
		<span><?= $label ?></span>
	<?php } ?>
	<ul>
		<?= $content ?>
	</ul>
</li>