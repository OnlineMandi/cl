<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
use kartik\slider\Slider;
use kartik\file\FileInput;

$this->registerJs(
    " 
		var element;
	"
);

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$main_image = \Yii::$app->request->baseUrl . '/uploads/no-image.png';
?>

<div class="basic-info">

     <div class="admin-display-header">
		<h4>Step 1: Add Product Basic Info</h4>
	</div>
	<div class="admin-display-box">
		<div class="admin-form sm-input">
		    <?php $form = ActiveForm::begin(['action' => 'add-product','options' => ['enctype' => 'multipart/form-data']]) ?>

				<input type="hidden" name="step" value="pbi">
				
				<div class="row">
					<div class="col-md-6">				
								
					<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'quantity')->textInput() ?>
					
					</div>
					<div class="col-md-6">				
								
					<?= $form->field($model, 'price')->textInput() ?>

					<?= $form->field($model, 'market_price')->textInput() ?>
					
					</div>					
					<div class="col-md-6">
						<?php
						$count = round(count($general_attrs)/2);
						$i = 0;
						foreach($general_attrs as $attr){
							if($count == $i){
								echo "</div><div class='col-md-6'>";
							}
							$attr_name = 'general_attrs['.$attr->id.']';
							
							echo $form->field($model, $attr_name)->dropDownList(
							$dropdownmodel->getAttrValues($attr->id),
							[
								'prompt'=>'- Select option -',
								'class'=>'form-control select2',
							]
							)->label($attr->name);
							$i++;
						}
						?>					
					</div>					
					
					
					<div class="col-md-12">
						<?= $form->field($model, 'description')->textArea(['rows' => '3']) ?>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<h4 class="head4-red">optional parameters</h4>
					</div>
				   <div class="col-md-6">
					   <div class="img-box1">
						   <p>This image below is not your product image. It is a an image to help you give us the accurate measurements of your product.</p>
						   <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/medium/category/<?= $category->image?>">
					   </div>
				   </div>
				   <div class="col-md-6">
						<h4 class="head4-borderd">Please fill in the measurements (Inches) of your product:</h4>
						<?php	
							foreach($slider_attrs as $attr){
								$attr_name = 'slider_attrs['.$attr->id.']';
								$attr_id = 'slider_attrs_'.$attr->id;
							
								echo $form->field($model, $attr_name,['options' => ['class' => 'form-group','id' => $attr_id]])->widget(Slider::classname(), [
									'sliderColor'=>Slider::TYPE_GREY,
									'handleColor'=>Slider::TYPE_DANGER,
									'pluginOptions'=>[
										'min' => $attr->lower_limit,
										'max' => $attr->upper_limit,
										'step' => 1,
										'handle' => 'triangle',
										'tooltip' => 'always'
									]
								])->label($attr->name);
														
							}
						?>					


				   </div>
				</div>				
				<div class="row">
					<div class="col-md-12">
						<h4 class="head4-red">Select Product Images</h4>
					</div>
					<div class="col-md-6">
					   <div class="img-box1">
							<h4 class="head4-borderd">Please upload main image here:</h4>
							<?= $form->field($ProductImagesModel, 'main_image')->widget(FileInput::classname(),
								[
									'options' => ['accept' => 'image/*'],
									'pluginOptions' => [
										'showCaption' => false,
										'showRemove' => true,
										'showUpload' => false,
										'initialPreview'=>[
											Html::img($main_image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
										],
									]
								]);
							?>						   
						   
					   </div>
					</div>
					<div class="col-md-6">
						<h4 class="head4-borderd">Please upload here all other images:</h4>
						<?php
							// Usage with ActiveForm and model
							echo $form->field($ProductImagesModel, 'other_image[]')->widget(FileInput::classname(), 
							[
								'options' => ['accept' => 'image/*','multiple' => true],    
								'pluginOptions' => [
									'showCaption' => false,
									'showRemove' => true,
									'showUpload' => false,
									'initialPreview'=>[
										Html::img($main_image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
									],									
								]
							]);
						?>
					</div>
				</div>						
			</div>	
		</div>
	</div>
<div class="product-form">

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
