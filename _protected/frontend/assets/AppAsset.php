<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

use yii\web\View;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * -----------------------------------------------------------------------------
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 * -----------------------------------------------------------------------------
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';
    
    public $css = [
		'css/bootstrap.min.css',
		'css/bootstrap-slider.css',
		'css/fonts.css',
		'css/font-icons.css',
		'https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css',			
		'css/style.css',		
		'css/jquery.bxslider.css',		
    ];
    public $js = [
		'js/jquery.min.js',
		'js/bootstrap-slider.min.js',
		'js/jquery.bxslider.min.js',
		'js/custom.js',
		'js/bootstrap.min.js',
    ];
	public $jsOptions = array(
		 'position' => View::POS_END // appear in the bottom of my page, but jquery is more down again
	);     
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

