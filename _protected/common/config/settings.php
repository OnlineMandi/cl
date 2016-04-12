<?php

namespace common\config;

use Yii;
use yii\base\BootstrapInterface;
use common\models\Globalsetting;
/*
/* The base class that you use to retrieve the settings from the database
*/

class settings implements BootstrapInterface {

    private $db;

    public function __construct() {
        $this->db = Yii::$app->db;
    }

    /**
    * Bootstrap method to be called during application bootstrap stage.
    * Loads all the settings into the Yii::$app->params array
    * @param Application $app the application currently running
    */

    public function bootstrap($app) {

		$Globalsetting = new Globalsetting();
		$Globalsettings = $Globalsetting->getLogoFevicon();
		foreach($Globalsettings as $settings ){
			foreach ($settings as $key => $val) {
				Yii::$app->params['settings'][$key] = $val;
			}
		}	
		Yii::$app->params['adminEmail'] = Yii::$app->params['settings']['admin_mail'];
		Yii::$app->params['siteName'] = Yii::$app->params['settings']['site_title'];
		Yii::$app->params['folder'] = Yii::getAlias('@uploads');  
		
		$webroot = str_replace('/backend','',Yii::getAlias('@webroot'));

		
		//thumb,medium,large image path
		Yii::$app->params['uploadThumbs'] = $webroot.'/uploads/thumbs/';
		Yii::$app->params['uploadLarge'] = $webroot.'/uploads/large/';
		Yii::$app->params['uploadMedium'] = $webroot.'/uploads/medium/';
		Yii::$app->params['uploadMain'] = $webroot.'/uploads/main/';
		
		
		Yii::$app->params['baseurl'] = str_replace('/backend','',\Yii::$app->request->baseUrl);
		
		Yii::$app->params['folders']['name'] = array('uploadMain','uploadLarge','uploadThumbs','uploadMedium');
		Yii::$app->params['folders']['size'] = array('uploadMain'=>'','uploadLarge'=>'800','uploadThumbs'=>'150','uploadMedium'=>'500');		
		
    }

}