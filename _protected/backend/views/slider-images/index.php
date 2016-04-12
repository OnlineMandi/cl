<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SliderImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $slider;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-images-index">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

					<p >
						<?= Html::a('Create Slide', ['create', 'slider' => 1], ['class' => 'btn btn-success']) ?>
					</p>
					<?php Pjax::begin() ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn','header' => 'S.No.'],

                            'title',
							[
								'attribute' => 'image',
								'format' => 'html',
								'enableSorting' => false,
								'value' => function ($model) {
									return Html::img(Yii::$app->params['baseurl']. '/uploads/thumbs/slides/' . $model->image,
										['width' => '80px']);
								},
								'contentOptions' => ['style' => 'width:260px;text-align:center;vertical-align: middle;'],
							],	
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    if ($model->status) {
                                        return Html::a(Yii::t('app', 'Active'), null, [
                                            'class' => 'btn btn-success status',
                                            'data-id' => $model->id,
                                            'href' => 'javascript:void(0);',
                                        ]);
                                    } else {
                                        return Html::a(Yii::t('app', 'Inactive'), null, [
                                            'class' => 'btn btn-danger status',
                                            'data-id' => $model->id,
                                            'href' => 'javascript:void(0);',
                                        ]);
                                    }
                                },
                                'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                'format' => 'raw',
                                'filter'=>array("1"=>"Active","0"=>"Inactive"),
                            ],
							[	
								'class' => 'yii\grid\ActionColumn','header'=>'Actions',
								'buttons' => [
									 'delete' => function ($url, $model) {
										return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
											'title' => Yii::t('app', 'Delete slider'),
											'data-confirm'=>'Are you sure you want to delete '.$model->title.' slider?',
											'data-method'=>'POST',
											'data-pjax' => '0',											
										]);
									}
								],
								'template' => '{update} {delete}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
							],
						],
					]); ?>
				<?php Pjax::end() ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>
