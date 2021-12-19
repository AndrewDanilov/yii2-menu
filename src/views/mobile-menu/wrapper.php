<?php

/* @var $this View */
/* @var $wrapperId string */
/* @var $content string */

use yii\web\View;

?>
<div style="display: none;">
	<div id="<?= $wrapperId ?>">
		<ul>
			<?= $content ?>
		</ul>
	</div>
</div>