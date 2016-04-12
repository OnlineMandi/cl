<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'full',
		'clientOptions' => [
		'filebrowserBrowseUrl' => Url::to(['uploadfile/browse']),
		'filebrowserUploadUrl' => Url::to(['uploadfile/url'])
		]
	]) ?>


    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
