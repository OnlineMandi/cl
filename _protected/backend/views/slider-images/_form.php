<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

if($model->image != ''){
    $image = \Yii::$app->request->baseUrl . '/uploads/thumbs/slides/'. $model->image;
}else{
    $image = \Yii::$app->request->baseUrl . '/uploads/slides/no-image.png';
}
?>

<div class="slider-images-form">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'
                    ]]); ?>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'image')->widget(FileInput::classname(),
                        [
                            'options' => ['accept' => 'image/*', 'value' => $model->image],
                            'pluginOptions' => [
                                'showCaption' => false,
                                'showRemove' => true,
                                'showUpload' => false,
                                'initialPreview'=>[
                                    Html::img($image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
                                ],
                            ]
                        ]);
                    ?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
