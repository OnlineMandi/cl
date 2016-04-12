<?php

namespace backend\controllers;

use Yii;
use common\models\Countries;
use common\models\SliderImages;
use common\models\SliderImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Response;


use common\traits\ImageUploadTrait;

/**
 * SliderImagesController implements the CRUD actions for SliderImages model.
 */
class SliderImagesController extends BackendController
{
	use ImageUploadTrait;


    public function behaviors()
    {
	    $behaviors = parent::behaviors();
		return $behaviors;
    }

    /**
     * Lists all SliderImages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SliderImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionHomeSlider()
    {
        $searchModel = new SliderImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,1);
        if(Yii::$app->request->isAjax && Yii::$app->request->post('status_token'))
        {
            $id = Yii::$app->request->post('id');
            $model = $this->findModel($id);
            return $this->changeStatus($model);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'slider' => 'Home Slider',
        ]);
    }

    /**
     * Displays a single SliderImages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SliderImages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($slider=0)
    {
        $sliders = [1 => ["Home Slider", "home-slider"]];
        $model = new SliderImages();
        $image = UploadedFile::getInstance($model, 'image');
        $model->slider_id = $slider;
		
        if ($model->load(Yii::$app->request->post())) {
			
			$model->image = $model->title;
            if($model->save()) {				
				if($image)
				{
					$name = str_replace(' ','-',strtolower($model->title.$model->id));
					$size = Yii::$app->params['folders']['size'];
					$main_folder = "slides";
					$image_name= $this->uploadImage($image,$name,$main_folder,$size);
					$model->updateAttributes(['image' => $image_name]);
				}
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'slider has been created successfully!'));
				return $this->redirect([$sliders[$slider][1]]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'sliders' => $sliders,
                ]);
            }


        } else {
            return $this->render('create', [
                'model' => $model,
                'sliders' => $sliders,
            ]);
        }
    }

    /**
     * Updates an existing SliderImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$imgval = $model->image;
		$image = UploadedFile::getInstance($model, 'image');

		if($image != '')
		{
			$newname = $model->title .''. $id;
			$name = str_replace(' ','-',strtolower($newname));
			$size = Yii::$app->params['folders']['size'];
			$main_folder = "slides";
			$image_name= $this->uploadImage($image,$name,$main_folder,$size);
			if($image_name)
				$imgval = $image_name;			
		}
		
        if ($model->load(Yii::$app->request->post())) {
			$model->image = $imgval;
			$model->save();	
			Yii::$app->getSession()->setFlash('success', Yii::t('app', 'slider has been updated successfully!'));
			return $this->redirect('home-slider');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SliderImages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success', Yii::t('app', 'slider has been deleted!'));
		return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionStatus($id)
    {

        $model = $this->findModel($id);
        if ($this->getIsActive($model)) {
            $this->inactive($model);
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Slide has been deactivated'));
        } else {
            $this->active($model);
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Slide has been activated'));
        }


        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionSliderCountries(){
        $model = new Countries();
        $dataProvider = $model->sliderCountries;
        return $this->render('slider-countries', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddCountries(){
        $model = new Countries();
        $dataProvider = $model->activeCountries;
        return $this->render('add-countries', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSliderStatus($id){
        $model = Countries::findOne($id);
        if ($model->is_slider_item == 1) {
            $model->updateAttributes(['is_slider_item' => 0]);
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Country has been removed from slider'));
        } else {
            $model->updateAttributes(['is_slider_item' => 1]);
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Country has been added to slider'));
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionUpdateSliderStatus(){
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = Countries::findOne($id);
            if ($model->is_slider_item == 1) {
                $result = $model->updateAttributes(['is_slider_item' => 0]);
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                   'result' => $result,
                    'action' => 'Add',
                ];
            } else {
                $result = $model->updateAttributes(['is_slider_item' => 1]);
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'result' => $result,
                    'action' => 'Remove',
                ];
            }
        }
    }
    protected function findModel($id)
    {
        if (($model = SliderImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
