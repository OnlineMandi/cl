<?php
namespace frontend\controllers;

use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use Yii;
use common\models\Profile;
use yii\widgets\ActiveForm;
use yii\web\Response;
class AccountController extends FrontendController
{
	
    public function actionIndex()
    { 
		return $this->render('index');
    }
	
    public function actionDashboard()
    { 
		return $this->render('dashboard');
    }

    public function actionInformation()
    { 

		$userId = \Yii::$app->user->identity->id;
		$profile = Profile::find()->where(['user_id' => $userId])->one();
		if (Yii::$app->request->isAjax && $profile->load(Yii::$app->request->post()))
		{			
			if(\yii\widgets\ActiveForm::validate($profile)){
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($profile);
			}else{
				$profile->save();
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Account Information updated successfully!'));
				return $this->redirect(['account/information']);
			}
		}	
		return $this->render('information',['profile' => $profile]);
    }

    public function actionAddress()
    { 
		return $this->render('address');
    }

    public function actionNewsletter()
    { 
		return $this->render('newsletter');
    }

    public function actionNotifications()
    { 
		return $this->render('notifications');
    }	

	public function beforeAction($action)
	{
		$this->layout = 'account'; 
		return parent::beforeAction($action);
	}	
}