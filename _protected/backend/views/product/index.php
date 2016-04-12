<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
					<p >
						<?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
					</p>
					<?php Pjax::begin() ?>

					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn','header' => 'S.No.'],
							'name',
							[
								'attribute' => 'seller_id',
								'value' => 'seller.name',
								'format' => 'raw',
								'label' => 'Seller Name',
								'filter' =>  $model->sellerfilter,
								'enableSorting' => false,
							],	
							[
								'attribute' => 'feat_image',
								'format' => 'html',
								'enableSorting' => false,
								'value' => function ($model) {
									return Html::img(Yii::$app->params['baseurl'] . '/uploads/thumbs/product/main/' .$model->id . '/' . $model->featImage->main_image,
										['width' => '80px']);
								},
								'contentOptions' => ['style' => 'width:260px;text-align:center;vertical-align: middle;'],
							],
							'quantity',
							// 'price',
							// 'market_price',
							// 'description:ntext',
                            [
								'attribute' => 'status',
								'value' => function ($model) {
									if ($model->status) {
										return Html::a(Yii::t('app', 'Active'), null, [
											'class' => 'btn btn-success status',
											'data-id' =>  $model->id,
											'href' => 'javascript:void(0);',
											'controller' => 'product',
										]);
									} else {
										return Html::a(Yii::t('app', 'Inactive'), null, [
											'class' => 'btn btn-danger status',
											'data-id' =>  $model->id,
											'href' => 'javascript:void(0);',
											'controller' => 'product',
										]);
									}
								},
								'contentOptions' => ['style' => 'width:160px;text-align:center'],
								'format' => 'raw',
								'filter'=>array("1"=>"Active","0"=>"Inactive"),
							],
							// 'soldout',
							// 'created_at',
							// 'updated_at',

							[	
								'class' => 'yii\grid\ActionColumn','header'=>'Actions',
								'buttons' => [
									 'delete' => function ($url, $model) {
										return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
											'title' => Yii::t('app', 'Delete slider'),
											'data-confirm'=>'Are you sure you want to delete '.$model->name.' slider?',
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
