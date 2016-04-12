<?php
namespace frontend\controllers;

use common\models\ProductImages;
use common\models\Product;
use common\models\Category;
use common\models\Comment;
use common\models\ProductDropdownValues;
use common\models\ProductSliderValues;

use yii\web\Response;

use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use Yii;


class WomenController extends FrontendController
{

    public function actionIndex()
    { 
	
		$this->layout = 'home';
		return $this->render('index');
    }
	
    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionProduct($id)
    {
		$this->layout = "product";
		$model = Product::findOne(['id'=>$id]);
        $commentModel = new Comment();
		$commentModel->user_id = \Yii::$app->user->identity->id;
		$commentModel->product_id = $id;
		$sliderModel = ProductSliderValues::find()->where(['product_id'=>$id])->all();
		$dropdownModel = ProductDropdownValues::find()->where(['product_id'=>$id])->all();
		$meauserments = array();
		$otherInfo = array();
		$all_cat = array();
		$brand = '';
		$categories = Category::findOne(['name' => $model->cat->name]);
		$parent_cat = $categories->parents()->all();
		foreach($parent_cat as $cat){
			$all_cat[$cat->id] = $cat->name;
		}
		foreach($sliderModel as $key => $slider){
			$meauserments[] = ['name'=>$slider->attr->name,'value'=>$slider->value];
		}
		foreach($dropdownModel as $dropdown){
			if($dropdown->value->attr->name == 'Brand')
				$brand = $dropdown->value->name;
			
			$otherInfo[] = ['value'=>$dropdown->value->name,'name'=>$dropdown->value->attr->name];
		}
		
        return $this->render('product', [
            'model' => $model,
            'imageModel' => ProductImages::findOne(['product_id'=>$id]),
            'commentModel' => $commentModel,
            'meauserments' => $meauserments,
            'otherInfo' => $otherInfo,
            'brand' => $brand,
            'all_cat' => $all_cat,
        ]);
    }
	
    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionCategory($id = 0)
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
            'model' => Product::findOne(['id'=>$id]),
            'imageModel' => ProductImages::findOne(['product_id'=>$id]),
            'commentModel' => $commentModel,
            'meauserments' => $meauserments,
            'otherInfo' => $otherInfo,
            'brand' => $brand,
        ]);
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
