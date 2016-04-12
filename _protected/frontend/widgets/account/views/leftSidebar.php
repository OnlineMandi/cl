<?php
	use yii\helpers\Url;
?>

<div class="admin-profile-box">
	<div class="profile-img-box">
		<img src="<?= Yii::$app->view->theme->baseUrl ?>/images/profile.jpg">
	</div>
	<h4><?= $user->profile->fname ?> <?= $user->profile->lname ?></h4>
	<span>Ambala City</span>
</div>

<h3 class="head2-admin">Profile</h3>
<div class="admin-menu-list">
	<?php
		//seller place
		if(!Yii::$app->user->can('seller') ){ ?>
			<a href="<?= Url::to(['customer/become-seller'])?>">Want to be seller ?</a>
	<?php } ?>

	<a href="<?= Url::to(['account/dashboard'])?>">Account Dashboard</a>
	<a href="<?= Url::to(['account/information'])?>">Account information</a>
	<a href="<?= Url::to(['account/address'])?>">Address Book</a>
	<a href="<?= Url::to(['account/newsletter'])?>">Newsletter subscription</a>
	<a href="<?= Url::to(['account/notifications'])?>">Notifications</a>

</div>

<?php
	//seller place
	if(isset($user->closet) && (\Yii::$app->user->can('seller')) ){ ?>
	<h3 class="head2-admin">Seller Place</h3>
	<div class="admin-menu-list">
		<a href="<?= Url::to(['seller/design'])?>">Design Your Closet</a>
		<a href="<?= Url::to(['seller/add-product'])?>">Add new product</a>
		<a href="<?= Url::to(['seller/feedbacks'])?>">Feedbacks posted for me</a>
		<a href="<?= Url::to(['seller/questions'])?>">Questions posted for me</a>
		<a href="<?= Url::to(['seller/list-products'])?>">My Products List</a>
		<a href="<?= Url::to(['seller/sold-products'])?>">My Sold Products</a>
		<a href="<?= Url::to(['seller/refunded-products'])?>">My Refunded Products</a>
		<a href="<?= Url::to(['seller/coupons'])?>">My Coupons</a>
		<a href="<?= Url::to(['seller/closet-lovers'])?>">My Closet Lovers</a>
		<a href="<?= Url::to(['seller/subscriptions'])?>">My Subscription Plans</a>
		<a href="<?= Url::to(['seller/comments'])?>">Comments posted on My Products</a>
	</div>
<?php } ?>
	
<h3 class="head2-admin">Customer Place</h3>
<div class="admin-menu-list">
	<a href="<?= Url::to(['customer/favourite'])?>">Favourite Closets</a>
	<a href="<?= Url::to(['customer/orders'])?>">My Orders</a>
	<a href="<?= Url::to(['customer/comments'])?>">My Comments</a>
	<a href="<?= Url::to(['customer/wishlist'])?>">My Wishlist</a>
	<a href="<?= Url::to(['customer/feedbacks'])?>">Feedbacks posted by me</a>
	<a href="<?= Url::to(['customer/questions'])?>">Questions posted by me</a>
</div>