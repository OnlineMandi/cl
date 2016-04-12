<?php 
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Women', 'url' => ['women/index']];
$this->params['breadcrumbs'][] = $this->title;

$mainLargeImgDir = Yii::$app->params['baseurl'] . '/uploads/large/product/main/' .$model->id . '/';
$mainMediumImgDir = Yii::$app->params['baseurl'] . '/uploads/medium/product/main/' .$model->id . '/';
$mainThumbImgDir = Yii::$app->params['baseurl'] . '/uploads/medium/product/main/' .$model->id . '/';
$thumbImgDir = Yii::$app->params['baseurl'] . '/uploads/thumbs/product/other/' .$model->id . '/';
$mediumImgDir = Yii::$app->params['baseurl'] . '/uploads/medium/product/other/' .$model->id . '/';
$largeImgDir = Yii::$app->params['baseurl'] . '/uploads/large/product/other/' .$model->id . '/';
$otherImages = unserialize($imageModel->other_image);

?> 
<div class="row">
	<div class="col-md-9 col-xs-12"">
		<div class="product-fullinfo">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="fullinfo-imgview">
						<div class="zoom-section">
							<div class="zoom-small-image">
								<a href='<?= $mainLargeImgDir.$imageModel->main_image ?>' class='cloud-zoom'  id='zoom2' rel="position:'inside',showTitle:false,adjustX:-4,adjustY:-4"><img src="<?= $mainMediumImgDir.$imageModel->main_image ?>" title="Your caption here" alt=''/></a>
							</div>
							
							<div class="zoom-desc">
								<?php foreach($otherImages as $otherImage){ ?>
									<a href='<?= $largeImgDir.$otherImage ?>' class='cloud-zoom-gallery' title='Red' rel="useZoom: 'zoom2', smallImage: '<?= $mediumImgDir.$otherImage ?>' ">
										<img class="zoom-tiny-image" src="<?= $thumbImgDir.$otherImage ?>" alt = "Thumbnail 1"/>
									</a>									
								<?php } ?>
								<a href='<?= $mainLargeImgDir.$imageModel->main_image ?>' class='cloud-zoom-gallery' title='Red' rel="useZoom: 'zoom2', smallImage: '<?= $mainMediumImgDir.$imageModel->main_image ?>' ">
									<img class="zoom-tiny-image" src="<?= $mainThumbImgDir.$imageModel->main_image ?>" alt = "Thumbnail 1"/>
								</a>
								
							</div>
						</div><!--zoom-section end-->
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="fullinfo-details">
						<h2><?= $model->name ?></h2>
						<h4><?= $brand ?></h4>
						<span class="price">
							<u><i class="fa fa-inr"></i> <?= $model->market_price ?></u>
							<b><i class="fa fa-inr"></i> <?= $model->price ?></b>
						</span>
						<div class="product-range">
							<span class="decrease"><i class="fa fa-minus"></i></span>
							<input id="range" type="number" value="1">
							<span class="increase"><i class="fa fa-plus"></i></span>
							<button><i class="fa fa-shopping-cart"></i> Add to Cart</button>
						</div>
						<div class="links">
							<a href="#"><i class="fa fa-heart"></i> Add to Wishlist</a>
							<a href="#"><i class="fa fa-envelope"></i> Email to a friends</a>
						</div>
						<!--p><b>SKU :</b>tsh3432</p-->
						<p><b>Categories :</b> <?= implode(', ',$all_cat) ?> , <?= $model->cat->name ?></p>
						<p><b>Tag :</b>womens tshirts</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="product-tab">
						<?= $this->render('tabs', ['tabs' => $tabs ,'meauserments' => $meauserments , 'otherInfo' => $otherInfo , 'commentModel' => $commentModel , 'model' => $model]) ?>
				
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-xs-12">
		<div class="left-bar drk">
			<h3>Product Categories</h3>
			<ul>
				<li><a href="#"><i class="fa fa-angle-right"></i>Bed</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Electronics</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Health</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Jewellery</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Laptop</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Men</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Shoes</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Sports</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Watches</a></li>
				<li><a href="#"><i class="fa fa-angle-right"></i>Women</a></li>
			</ul>
		</div>
	</div>