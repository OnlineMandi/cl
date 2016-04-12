<?php
use frontend\assets\AccountAsset;
use frontend\widgets\Alert;
use frontend\widgets\Mainheader;
use frontend\widgets\account\Leftsidebar;
use frontend\widgets\home\FooterMenu;

use yii\helpers\Html;
use yii\helpers\Url;


AccountAsset::register($this);
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
    <div class="wt-full-box">
        <div class="container">
            <div class="row">	
	            <div class="col-md-3">
					<?= Leftsidebar::widget() ?>
				</div>
				<div class="col-md-9">
					<?= Alert::widget() ?>
					<?= $content ?>
				</div>	
			</div>
        </div>
    </div>	
	<?= FooterMenu::widget() ?>		
		
<!--page js and css-->
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
