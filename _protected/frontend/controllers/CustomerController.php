<?php
namespace frontend\controllers;

use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use Yii;

use common\rbac\models\Role;

class CustomerController extends FrontendController
{

    public function actionFavourite()
    { 
		return $this->render('favourite');
    }
	
    public function actionBecomeSeller()
    { 
		$auth = Yii::$app->authManager;
		Role::deleteAll(['user_id' => Yii::$app->user->getId()]);
		$role = $auth->getRole('seller');
		$auth->assign($role, Yii::$app->user->getId());
        Yii::$app->session->setFlash('success','Congratulations! now you are a seller');		
        return $this->redirect(['account/index']);
    }
	
    public function actionOrders()
    { 
		return $this->render('orders');
    }

    public function actionFeedbacks()
    { 
		return $this->render('feedbacks');
    }

    public function actionQuestions()
    { 
		return $this->render('questions');
    }

    public function actionWishlist()
    { 
		return $this->render('wishlist');
    }	

    public function actionComments()
    { 
		return $this->render('comments');
    }

	public function beforeAction($action)
	{
		$this->layout = 'account'; 
		return parent::beforeAction($action);
	}
}