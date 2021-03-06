<?php 


use yii\helpers\Html;
use kartik\file\FileInput;

use yii\helpers\Url;

use dosamigos\ckeditor\CKEditor;

if($node->image != ''){
    $image = Yii::$app->params['baseurl'].'/uploads/thumbs/category/'. $node->image;
}else{
    $image = Yii::$app->params['baseurl'].'/uploads/no-image.png';
}

if($node->banner != ''){
    $banner = Yii::$app->params['baseurl'].'/uploads/thumbs/category/'. $node->banner;
}else{
    $banner = Yii::$app->params['baseurl'].'/uploads/no-image.png';
}

?>


<?= $form->field($node, 'slug')->textInput(['maxlength' => true]) ?> 

<?= $form->field($node, 'descr')->widget(CKEditor::className(), [
	'options' => ['rows' => 6],
	'preset' => 'full',
	'clientOptions' => [
	'filebrowserBrowseUrl' => Url::to(['uploadfile/browse']),
	'filebrowserUploadUrl' => Url::to(['uploadfile/url'])
	]
]) ?>
<?= $form->field($node, 'image')->widget(FileInput::classname(),
	[
		'options' => ['accept' => 'image/*', 'value' => $node->image],
		'pluginOptions' => [
			'showCaption' => false,
			'showRemove' => true,
			'showUpload' => false,
			'initialPreview'=>[
				Html::img($image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
			],
		]
	]) ?>
		
<?= $form->field($node, 'banner')->widget(FileInput::classname(),
	[
		'options' => ['accept' => 'image/*', 'value' => $node->banner],
		'pluginOptions' => [
			'showCaption' => false,
			'showRemove' => true,
			'showUpload' => false,
			'initialPreview'=>[
				Html::img($banner, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
			],
		]
	]) ?>		
<?= $form->field($node, 'status')->dropDownList(['1' => 'Active','0' => 'Inactive']); ?>	                  
<?= $form->field($node, 'ptype')->dropDownList(['0' => 'Single','1' => 'Combo',]); ?>	                  

<?= $form->field($node, 'meta_title')->textInput(['maxlength' => true]) ?> 
<?= $form->field($node, 'meta_descr')->textInput(['maxlength' => true]) ?>