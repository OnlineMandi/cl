<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CountriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Add or Remove Countries in Country Slider';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countries-index">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <p>
                        <?= Html::a('Back to Countries Slider', ['slider-countries'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?php Pjax::begin() ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn',
                                'header' => 'S.No.'],
                            'name',
                            [
                                'attribute' => 'is_slider_item',
                                'value' => function ($model) {
                                    if (!$model->is_slider_item) {
                                        return Html::a(Yii::t('app', 'Add'), null, [
                                            'class' => 'btn btn-success a_r',
                                            'data-id' =>  $model->id,
                                            'href' => 'javascript:void(0);',
                                        ]);
                                    } else {
                                        return Html::a(Yii::t('app', 'Remove'), null, [
                                            'class' => 'btn btn-danger a_r',
                                            'data-id' =>  $model->id,
                                            'href' => 'javascript:void(0);',
                                        ]);
                                    }
                                },
                                'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                'format' => 'raw',
                                'filter'=>array("1"=>"Active","0"=>"Inactive"),
                            ],
                            /*[
                                'class' => 'yii\grid\ActionColumn','header'=>'Actions',
                                'buttons' => [
                                    'view-details' =>function ($url, $model, $key) {
                                        $options = array_merge([
                                            'title' => Yii::t('yii', 'View Details'),
                                            'aria-label' => Yii::t('yii', 'View Details'),
                                            'data-pjax' => '0',
                                        ], []);
                                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view','id'=>$model->id], $options);
                                    },
                                ],
                                'template' => '{viewstates} {view-details} {update}',
                                'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
                            ],*/
                        ],
                    ]); ?>
                    <?php Pjax::end() ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
