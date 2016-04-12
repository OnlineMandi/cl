<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\States */

$this->title = 'Add New State';
$this->params['breadcrumbs'][] = ['label' => 'All States', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="states-create">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
