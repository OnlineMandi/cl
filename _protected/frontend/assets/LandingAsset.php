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
class LandingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';
    
    public $css = [
		'css/bootstrap.min.css',
		'css/fonts.css',
		'css/bootstrap-theme.css'		
    ];
    public $js = [
		'js/prefixfree.min.js',
		'js/index.js',
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

