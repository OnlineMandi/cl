<?php
use frontend\assets\LandingAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;

LandingAsset::register($this);
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
	<div class="landing-full-box">
		<header class="header">
			<div class="container">
				<div class="row">
					 <div class="landing-logo"><a href="<?= Url::to(['']) ?>"><img src="<?= Yii::$app->view->theme->baseUrl ?>/images/logo-1.png"></a></div>
				</div>
			</div>
		</header>
		<section class="landing-content">
		   <div class="container">
			   <div class="row">
					<?= Alert::widget() ?>
					<?= $content ?>
			   </div>
		   </div>
		</section>
	</div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
