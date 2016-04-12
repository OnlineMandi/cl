<?php

namespace frontend\controllers;

use Yii;
use common\models\ProductImages;
use common\models\Product;
use common\models\ProductDropdownValues;
use common\models\ProductSliderValues;

use common\models\Comment;
use common\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
	public function beforeAction($action)
	{
		$this->layout = 'account'; 
		return parent::beforeAction($action);
	}

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$this->layout = "product";
		
        $commentModel = new Comment();
		$commentModel->user_id = \Yii::$app->user->identity->id;
		$commentModel->product_id = $id;
		$sliderModel = ProductSliderValues::find()->where(['product_id'=>$id])->all();
		$dropdownModel = ProductDropdownValues::find()->where(['product_id'=>$id])->all();
		$meauserments = array();
		$otherInfo = array();
		$brand = '';
		foreach($sliderModel as $key => $slider){
			$meauserments[] = ['name'=>$slider->attr->name,'value'=>$slider->value];
		}
		foreach($dropdownModel as $dropdown){
			if($dropdown->value->attr->name == 'Brand')
				$brand = $dropdown->value->name;
			
			$otherInfo[] = ['value'=>$dropdown->value->name,'name'=>$dropdown->value->attr->name];
		}
		
        return $this->render('product', [
            'model' => $this->findModel($id),
            'imageModel' => ProductImages::findOne(['product_id'=>$id]),
            'commentModel' => $commentModel,
            'meauserments' => $meauserments,
            'otherInfo' => $otherInfo,
            'brand' => $brand,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
    /**
     * Comment
     * @param integer $id
     * @return mixed
     */
    public function actionComment()
    {
		echo "<pre>";
		print_r($_POST);
		die;
		$model = new Comment();
		if ($model->load(Yii::$app->request->post()) && $model->save()) {			
			$result['type'] = 'success';
			$result['message'] = 'Thank you for your review!';
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
			return $result;			

		}else{	
			$error = \yii\widgets\ActiveForm::validate($model);
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $error; 
		}		
    }	
	
}
