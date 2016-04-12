<?php
namespace frontend\controllers;


use common\models\Product;
use common\models\ProductForm;
use common\models\Category;
use common\models\Attributes;
use common\models\ProductSliderValues;
use common\models\ProductDropdownValues;
use common\models\ProductImages;
use common\models\DropdownValuesSearch;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use Yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use common\traits\ImageUploadTrait;
use yii\web\UploadedFile;

class SellerController extends FrontendController
{
	use ImageUploadTrait;
    public function actionIndex()
    { 
		return $this->render('index');
    }
	
    public function actionDesign()
    { 
		return $this->render('design');
    }

    public function actionAddProduct($start=0)
    { 

		$session = Yii::$app->session;
		if($start ==1){
			$session->remove('category_id');
			$session->remove('seller_id');
			$session->remove('last_selected_step');
			$session->remove('selected_categories');
			
		}		
		if (!$session->isActive){
			// open a session
			$session->open();			
		}
		
		$model = new Product();	
		$ProductImagesModel = new ProductImages();
		if(Yii::$app->request->isPost){

			if(Yii::$app->request->post('step')=="sc"){
			    $selected_categories = Yii::$app->request->post('ProductForm')['category'];
				$model->category_id = $selected_categories[count($selected_categories)-1];
				$model->seller_id = Yii::$app->user->identity->id;
				
				//store sc data to session 
				$session->set('category_id', $model->category_id);
				$session->set('seller_id', $model->seller_id);
				$session->set('last_selected_step', "sc");
				$session->set('selected_categories', json_encode($selected_categories));
				
				$categoryModel = Category::findOne($model->category_id);
				
				if (($attrsModel = $categoryModel->categoryAttributes) === null) {
					$attrsModel = $categoryModel->createAttrsModel;
				}
				
				$general_added = unserialize($attrsModel->general_attributes);
				
				$general_attrs = array();
				foreach($general_added as $attr){
					$general_attrs[] = Attributes::findOne(['id'=>$attr]);
				}
				$slider_added = unserialize($attrsModel->slider_attributes);
				$slider_attrs = array();
				foreach($slider_added as $attr){
					$slider_attrs[] = Attributes::findOne(['id'=>$attr]);
				} 
					
				return $this->render('addBasicProdInfo', [
					'model' => $model,
					'slider_attrs' => $slider_attrs,
					'general_attrs' => $general_attrs,
					'dropdownmodel' => new DropdownValuesSearch,
					'category' => $categoryModel,
					'ProductImagesModel' => $ProductImagesModel,
					
				]);	
				
			}else if(Yii::$app->request->post('step')=="pbi"){
				
				$main_image = UploadedFile::getInstance($ProductImagesModel, 'main_image');
				$other_images = UploadedFile::getInstances($ProductImagesModel, 'other_image');

				//product save
				if($model->load(Yii::$app->request->post())){
					$model->category_id = $session->get('category_id');					
					$model->seller_id = Yii::$app->user->identity->id;
					
					if($model->save()){
						
						//save dropdown values
						foreach($model->general_attrs as $gen_attrs){
							$ProductDropdownValues = new ProductDropdownValues;
							$ProductDropdownValues->product_id = $model->id;
							$ProductDropdownValues->value_id = $gen_attrs;
							$ProductDropdownValues->save();
						}					
						
						//save slider values
						foreach($model->slider_attrs as $key=>$slider_attrs){
							$ProductSliderValues = new ProductSliderValues;
							$ProductSliderValues->product_id = $model->id;
							$ProductSliderValues->attr_id = $key;
							$ProductSliderValues->value = $slider_attrs;
							$ProductSliderValues->save();
						}
						
						$ProductImagesModel->product_id = $model->id;
						//save main image
						if($main_image)
						{
							$name = time().$model->id;
							$size = Yii::$app->params['folders']['size'];
							$main_folder = "product/main/".$model->id;
							$image_name= $this->uploadImage($main_image,$name,$main_folder,$size);
							$ProductImagesModel->main_image = $image_name;
						}						
						
						//save all other images
						if($other_images)
						{
							
							$prod_otherimages = array();
							foreach($other_images as $other_image){	

								$name = time().$model->id;
								$size = Yii::$app->params['folders']['size'];
								$main_folder = "product/other/".$model->id;
								$image_name= $this->uploadImage($other_image,$name,$main_folder,$size);
								$prod_otherimages[] = $image_name;
							}
							$ProductImagesModel->other_image = serialize($prod_otherimages);							
						}	
						$ProductImagesModel->save();
						
					}else{
						print_r($model->getErrors());
						die;
					}						
				}else{
						print_r($model->getErrors());
						die;
					}
					
				Yii::$app->getSession()->setFlash('success', Yii::t('app', "Congratulations! your product is successfully created and sent to admin for approval."));
				$model = new ProductForm();	
				return $this->render('select-category', [
					'model' => $model,
				]);			
			}		
            
        } else {

			if ($session->has('last_selected_step')){ 
			
				$selected_categories = json_decode($session->get('selected_categories'));			
				
				//update previous product
 				if($session->get('last_selected_step')=="sc"){
					if(Yii::$app->user->identity->id !== $session->get('seller_id')){
						return $this->redirect(['select-category']);	
					}					
					$model->category_id = $session->get('category_id');					
					$model->seller_id = Yii::$app->user->identity->id;
					
					$categoryModel = Category::findOne($model->category_id);
					
					if (($attrsModel = $categoryModel->categoryAttributes) === null) {
						$attrsModel = $categoryModel->createAttrsModel;
					}
					
					$general_added = unserialize($attrsModel->general_attributes);
					
					$general_attrs = array();
					foreach($general_added as $attr){
						$general_attrs[] = Attributes::findOne(['id'=>$attr]);
					}
					$slider_added = unserialize($attrsModel->slider_attributes);
					$slider_attrs = array();
					foreach($slider_added as $attr){
						$slider_attrs[] = Attributes::findOne(['id'=>$attr]);
					} 
					$ProductImagesModel = new ProductImages();	
					return $this->render('addBasicProdInfo', [
						'model' => $model,
						'slider_attrs' => $slider_attrs,
						'general_attrs' => $general_attrs,
						'dropdownmodel' => new DropdownValuesSearch,
						'category' => $categoryModel,
						'ProductImagesModel' => $ProductImagesModel,
					]);	
					
				}else if($session->get('last_selected_step')=="pbi"){
					$selected_categories = Yii::$app->request->post('ProductForm')['category'];
					$model->category_id = $selected_categories[count($selected_categories)-1];
					$model->seller_id = Yii::$app->user->identity->id;
					
					//store sc data to session 
					$session->set('category_id', $model->category_id);
					$session->set('seller_id', $model->seller_id);
					
					$categoryModel = Category::findOne($model->category_id);
					if (($attrsModel = $categoryModel->categoryAttributes) === null) {
						$attrsModel = $categoryModel->createAttrsModel;
					}
					$general_added = unserialize($attrsModel->general_attributes);
					$general_attrs = array();
					foreach($general_added as $attr){
						$general_attrs[] = Attributes::findOne(['id'=>$attr]);
					}
					$slider_added = unserialize($attrsModel->slider_attributes);
					$slider_attrs = array();
					foreach($slider_added as $attr){
						$slider_attrs[] = Attributes::findOne(['id'=>$attr]);
					} 
										
					return $this->render('addBasicProdInfo', [
						'model' => $model,
						'slider_attrs' => $slider_attrs,
						'general_attrs' => $general_attrs,					
						'dropdownmodel' => new DropdownValuesSearch,
						'category' => $categoryModel,						
					]);					
					
				} 				
			}else{
				//add new product
				$model = new ProductForm();	
				$session->remove('category_id');
				$session->remove('seller_id');
				$session->remove('last_selected_step');
				$session->remove('selected_categories');
				return $this->render('select-category', [
					'model' => $model,
				]);
			}			
        }
    }
	
	public function actionSubcategories($id)
    { 
		$model = new ProductForm();
		$result = $model->getCategories($id);
		$count = $model->getCategoriesCount($id);
		if($count){
			Yii::$app->response->format = Response::FORMAT_JSON;	
		return [
        'result' => $result,		
        'count' => $count,		
		];
		} else {
			
			Yii::$app->response->format = Response::FORMAT_JSON;	
		return [
        'result' => $result,		
        'count' => $count,		
		];
		}
				
    }

    public function actionFeedbacks()
    { 
		return $this->render('feedbacks');
    }

    public function actionQuestions()
    { 
		return $this->render('questions');
    }

    public function actionListProducts()
    { 
		return $this->render('listProducts');
    }	
	
    public function actionSoldProducts()
    { 
		return $this->render('soldProducts');
    }	

    public function actionRefundedProducts()
    { 
		return $this->render('refundedProducts');
    }	

    public function actionClosetLovers()
    { 
		return $this->render('closetLovers');
    }

    public function actionSubscriptions()
    { 
		return $this->render('subscriptions');
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