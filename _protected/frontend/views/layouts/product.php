<?php
use frontend\assets\ProductAsset;
use frontend\widgets\Alert;
use frontend\widgets\Mainheader;
use frontend\widgets\home\MobileMenu;
use frontend\widgets\home\FooterMenu;

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

ProductAsset::register($this);
$baseUrl = Yii::$app->view->theme->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <header class="header blk-bg">
        <div class="container">
            <div class="row">
				<?= Mainheader::widget() ?>
            </div>
        </div>
    </header>
	
	
    <div class="bg"></div>
    <div class="mobi-menu">
        <ul>
            <li class="active"><a href="#">Women</a></li>
            <li><a href="<?= Url::to(['men/index']) ?>">Men</a></li>
            <li><a href="#">Brands</a></li>
            <li><a href="#">Designers</a></li>
            <li><a href="#">How it Works</a></li>
            <li><a href="#">Start Selling</a></li>
            <li><a href="javascript:void(0);" data-popup-id="login">Login</a></li>
            <!--li><a href="<?= Url::to(['site/signup']) ?>" data-popup-id="login">Login</a></li-->
        </ul>
    </div>
	
	<div class="sub-page-header">
        <div class="container">
            <h1>WOMEN DRESSES</h1>
			<?= Breadcrumbs::widget([
				'itemTemplate' => "<li>{link}</li>", // template for all links
				'tag' => 'ol',
				'homeLink' => [ 
                      'label' => Yii::t('yii', 'Home'),
                      'url' => Yii::$app->homeUrl,
                 ],			
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>			

        </div>
    </div>

    <div class="wt-full-box">
        <div class="container">
			<?= Alert::widget() ?>
			<?= $content ?>			
		</div>
	</div>	
	</div>
	<?= FooterMenu::widget() ?>		
	
	<?= $this->render('popups.php',[]) ?>
	
<!--page js and css-->
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
