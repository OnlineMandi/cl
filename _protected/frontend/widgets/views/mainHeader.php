<?php 
	use frontend\widgets\home\Mainmenu;	
	use yii\helpers\Url;
?>

<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</button>
<div class="logo">
	<a href=""><img src="<?= Yii::$app->view->theme->baseUrl ?>/images/logo-1.png" /></a>
</div>
<div class="header-rightbox">
	<!--div class="cart-btn">
		<span><b>Cart - </b><i>Rs 0.00</i></span>
		<p>0 item(s) in cart</p>
	</div-->
	<div class="cart-btn">
		<span>
			<?php if(Yii::$app->user->isGuest){ ?>
				<b><a href="javascript:void(0);" data-popup-id="login">Login</a></b> / 
				<b><a href="javascript:void(0);" data-popup-id="signup">Register</a></b>
			<?php }else{
				?>
				<b><a href="<?= Url::to(['account/dashboard'])?>">My Account</a></b> / 
				<b><a href="<?= Url::to(['site/logout'])?>" data-method="post">Logout</a></b> 
				<?php
			} ?>
		</span>
	</div>
	<ul>
		<li>
			<a href="#"><i class="icon-phone"></i></a>
		</li>
		<li>
			<a href="#"><i class="icon-star-full"></i></a>
		</li>
		<li>
			<a href="#"><i class="fa fa-shopping-cart"></i></a>
		</li>
	</ul>
</div>
<div class="cart-btn-mobi">
	<img src="<?= Yii::$app->view->theme->baseUrl ?>/images/icons/cart1.svg">
</div>
<div class="cart-btn-mobi">
	<span class="icon-star-empty"></span>
</div>
<div class="navbar-box">
	<nav class="navbar">
		<?= Mainmenu::widget() ?>
	</nav>
</div>