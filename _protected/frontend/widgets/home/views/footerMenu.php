<?php 
use yii\helpers\Url;
?>
<footer class="footer">
	<h6>Follow us on</h6>
	<div class="social-icons">
		<a href="#"><i class="icon-facebook"></i></a>
		<a href="#"><i class="icon-twitter"></i></a>
		<a href="#"><i class="icon-feed2"></i></a>
		<a href="#"><i class="icon-vimeo"></i></a>
		<a href="#"><i class="icon-github4"></i></a>
		<a href="#"><i class="icon-share2"></i></a>
	</div>
	<div class="footer-nav">
		<?php 
		foreach($menus as $key => $parent_menu){

					$url = Yii::$app->homeUrl.$parent_menu['link'];										
					?>
				<a href="<?= $url ?>"><?= $parent_menu['name'] ?></a>
			<?php }
 ?>
	</div>	
	
	
	<img src="<?= Yii::$app->view->theme->baseUrl ?>/images/footer_logo_1.png">
	<span>Closera &copy; 2014 </span>
</footer>