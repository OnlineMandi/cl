<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\traits\StatusChangeTrait;
use common\traits\AjaxStatusTrait;

use common\traits\ImageUploadTrait;



/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BackendController
{

	use ImageUploadTrait;
	use StatusChangeTrait;
	use AjaxStatusTrait;
	
    public function behaviors()
    {
	    $behaviors = parent::behaviors();
		return $behaviors;
    }
    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		echo "hello";
		die;
        $model = new Category();
        $image = UploadedFile::getInstance($model, 'image');
        $banner = UploadedFile::getInstance($model, 'banner');
		
        if ($model->load(Yii::$app->request->post())) {
			$model->image = $model->title;
			
            if($model->save()) {				
				if($image)
				{
					$name = str_replace(' ','-',strtolower($model->title.$model->id));
					$size = Yii::$app->params['folders']['size'];
					$main_folder = "category";
					$image_name= $this->uploadImage($image,$name,$main_folder,$size);
					$model->updateAttributes(['image' => $image_name]);
				}
				if($banner)
				{
					$name = str_replace(' ','-',strtolower($model->title.'_banner_'.$model->id));
					$size = Yii::$app->params['folders']['size'];
					$main_folder = "category";
					$image_name= $this->uploadImage($banner,$name,$main_folder,$size);
					$model->updateAttributes(['image' => $image_name]);
				}	
				
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'slider has been created successfully!'));
				return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'sliders' => $sliders,
                ]);
            }			
			
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
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
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
