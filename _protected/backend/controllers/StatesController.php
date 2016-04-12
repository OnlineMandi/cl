<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\traits\AjaxStatusTrait;
use common\traits\StatusChangeTrait;
use yii\web\NotFoundHttpException;
use common\models\States;
use common\models\StatesSearch;
use common\models\Cities;
use common\models\CitiesSearch;
/**
 * StatesController implements the CRUD actions for States model.
 */
class StatesController extends BackendController
{
	use StatusChangeTrait;

    /**
     * Lists all States models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(Yii::$app->request->isAjax && Yii::$app->request->post('status_token'))
        {
            $id = Yii::$app->request->post('id');
            $model = $this->findModel($id);
            return $this->changeStatus($model);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single States model.
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
     * Creates a new States model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new States();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing States model.
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
     * Deletes an existing States model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionStatus($id)
    { 

		$model = $this->findModel($id);
		if ($this->getIsActive($model)) {
			$this->inactive($model);
			Yii::$app->getSession()->setFlash('success', Yii::t('app', '<span style="font-weight:bold">'.$model->name.'</span> has been de-activated'));
		} else {
			$this->active($model);
			Yii::$app->getSession()->setFlash('success', Yii::t('app', '<span style="font-weight:bold">'.$model->name.'</span> has been activated'));
		}
  

       return $this->redirect(Yii::$app->request->referrer);
    }
	
	public function actionViewcities($state_id)
    {
        $searchModel = new CitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$state_id);
        if(Yii::$app->request->isAjax && Yii::$app->request->post('status_token'))
        {
            $id = Yii::$app->request->post('id');
            $model = $this->findCity($id);
            return $this->changeStatus($model);
        }
        return $this->render('viewcities', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $this->findModel($state_id),
        ]);
    }
	public function actionActiveCities($state_id)
    {
        $searchModel = new CitiesSearch();
        $dataProvider = $searchModel->searchstatus(Yii::$app->request->queryParams,$state_id,1);
        if(Yii::$app->request->isAjax && Yii::$app->request->post('status_token'))
        {
            $id = Yii::$app->request->post('id');
            $model = $this->findCity($id);
            return $this->changeStatus($model);
        }
        return $this->render('viewcities', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $this->findModel($state_id),
        ]);
    }
	public function actionInactiveCities($state_id)
    {
        $searchModel = new CitiesSearch();
        $dataProvider = $searchModel->searchstatus(Yii::$app->request->queryParams,$state_id,0);
        if(Yii::$app->request->isAjax && Yii::$app->request->post('status_token'))
        {
            $id = Yii::$app->request->post('id');
            $model = $this->findCity($id);
            return $this->changeStatus($model);
        }
        return $this->render('viewcities', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $this->findModel($state_id),
        ]);
    }
	
	public function actionCityStatus($id)
    { 
		$model = $this->findCity($id);
		if ($this->getIsActive($model)) {
			$this->inactive($model);
			Yii::$app->getSession()->setFlash('success', Yii::t('app', '<b>'.$model->name.'</b> has been de-activated'));
		} else {
			$this->active($model);
			Yii::$app->getSession()->setFlash('success', Yii::t('app', '<b>'.$model->name.'</b> has been activated'));
		}  

       return $this->redirect(Yii::$app->request->referrer);
    }
	
    protected function findModel($id)
    {
        if (($model = States::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findCity($id)
    {
        if (($model = Cities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
