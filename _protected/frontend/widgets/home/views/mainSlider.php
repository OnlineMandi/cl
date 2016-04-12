<section class="main-slider">
	<ul class="bxslider">
		<?php
		foreach($images as $image){	
		?>	
			<li><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/large/slides/<?= $image->image ?>" /></li>
		<?php } ?>
	</ul>
</section>