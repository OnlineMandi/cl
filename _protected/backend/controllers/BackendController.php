<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

/**
 * BackendController extends Controller and implements the behaviors() method
 * where you can specify the access control ( AC filter + RBAC) for 
 * your controllers and their actions.
 */
class BackendController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     * Here we use RBAC in combination with AccessControl filter.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['user'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'controllers' => ['global-setting','parent-menu','pages'],
                        'actions' => ['delete'],
                        'allow' => true,
                       'roles' => ['theCreator'],
                    ],
					[
                        'controllers' => ['cmenu'],
                        'actions' => ['delete'],
                        'allow' => true,
                       'roles' => ['admin'],
                    ],
	                [
                        'controllers' => ['gii','global-setting','parent-menu','cmenu','uploadfile','pages'],
                        'actions' => ['index', 'view', 'create', 'update','update-any-status','viewmenus','c-menu','values','status','url','browse','inactive','active'],
                        'allow' => true,
                       'roles' => ['admin'],
                    ],
	                [
                        'controllers' => ['attributes','entity','category','type','menu','slider-images'],
                        'actions' => ['home-slider','index', 'view', 'create', 'update','viewmenus','c-menu','values','status','url','browse','inactive','active','manage-attributes','add-attributes','sort-general-attrs','sort-slider-attrs'],
                        'allow' => true,
                       'roles' => ['admin'],
                    ],					

                ], // rules

            ], // access

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], // verbs

        ]; // return

    } // behaviors
	
    public function actionUpdateAnyStatus(){

		if(Yii::$app->request->isAjax && Yii::$app->request->post('status_token')){
			$add = 'Inactive';
			$remove = 'Active';
			
            $id = Yii::$app->request->post('id');
            $field = Yii::$app->request->post('field');
			if($field == 'status'){
				$add = 'Inactive';
				$remove = 'Active';
			}
			
            $model = Yii::$app->request->post('model');
			
			if($model){
				$model = 'common\models\\'.$model;
				$model = $model::findOne($id);
			}else{
				$model = $this->findModel($id);
			}
			
			if($model->$field == 1){

				$result = (bool)$model->updateAttributes([$field => 0]);
				Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
				return [
					'result' => $result,
					'action' => $add,
				];
			} else {

				$result = (bool)$model->updateAttributes([$field => 1]);
				Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
				return [
					'result' => $result,
					'action' => $remove,
				];
			}
        }
    }	

} // BackendController