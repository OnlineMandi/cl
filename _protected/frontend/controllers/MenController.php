<?php
namespace frontend\controllers;

use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use Yii;


class MenController extends FrontendController
{

    public function actionIndex()
    { 
	
		$this->layout = 'home';
		return $this->render('index');
    }

}
