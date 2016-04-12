<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Cities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn', 'header' => 'S.No.'],

							'name',
							
							[
                                'attribute' => 'state_id',
                                'value' => 'state.name',
                                'format' => 'raw',
                                'filter' =>  $model->activestatesfilter,
                                'enableSorting' => false,
                            ],
						],
					]); ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
    </div><!-- /.row -->
</div>
