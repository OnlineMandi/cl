<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CountriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Slider Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countries-index">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body table-responsive">
					<p>
						<?= Html::a('Add or Remove Countrie', ['add-countries'], ['class' => 'btn btn-success']) ?>
					</p>
					<?php Pjax::begin() ?>
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'columns' => [
							['class' => 'yii\grid\SerialColumn',
							'header' => 'S.No.'],
							'name',
							[
								'attribute' => 'flag',
								'format' => 'image',
								'value' => function($model) { return '@web/uploads/country/32x32/'.$model->flag; },
								'contentOptions' => ['class' => 'gridview-img'],
								'filter' => false,
								'enableSorting' => false,
							],
						],
					]); ?>
					<?php Pjax::end() ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
    </div><!-- /.row -->	
</div>
