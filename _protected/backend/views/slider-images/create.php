<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SliderImages */


$this->title = $sliders[$model->slider_id][0].' - Add Slide';
$this->params['breadcrumbs'][] = ['label' => $sliders[$model->slider_id][0], 'url' => [$sliders[$model->slider_id][1]]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-images-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
