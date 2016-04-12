<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJs(
    " 
		var element;
	"
);

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

     <div class="admin-display-header">
		<h4>Add Product</h4>
		<a href="#">View</a>
	</div>
	<div class="admin-display-box">
		<div class="admin-form sm-input">
			<?php $form = ActiveForm::begin(); ?>
				<div class="row">
					<div class="col-md-6">
						<?= $form->field($model, 'category[1]')->dropDownList(
							$model->getCategories(1),
							[
								'prompt'=>'- Select Category -',
								'class'=>'form-control select1',
								'onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('/seller/subcategories?id=').'"+$(this).val(), function( data ) {
									  $( "select#productform-category-2" ).html("");
									  $( "select#productform-category-2" ).append("<option value=\"\">Select sub-category</option>");  
									  for(var index in data.result){
										  if(!data.result.hasOwnProperty(index)){
											  continue;
										  }
										$( "select#productform-category-2" ).append("<option value="+index+">"+ data.result[index]+"</option>");  
									  }
									  
									});'

							]
						)->label('Main Category') 
						?>
						
						<?= $form->field($model, 'category[2]')->dropDownList(
							[],
							[
								'prompt'=>'- Select Sub Category -',
								'class'=>'form-control select2',
								'onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('/seller/subcategories?id=').'"+$(this).val(), function( data ) {
									if($( ".field-productform-category-3").length){
										$( "select#productform-category-3" ).html("");
										element = $( ".field-productform-category-3");
									} else {
										$("#dd").html(element);
									}
									
									if(data.count){										
									  $( "select#productform-category-3" ).append("<option value=\"\">Select child category</option>");  
									  for(var index in data.result){
										  if(!data.result.hasOwnProperty(index)){
											  continue;
										  }
										$( "select#productform-category-3" ).append("<option value="+index+">"+ data.result[index]+"</option>");  
									  }
									} else {
										$( ".field-productform-category-3").remove();
									}
									  
									  
									});'
							]
						)->label('Sub Category') 
						?>
						<span id="dd">
						<?= $form->field($model, 'category[3]')->dropDownList(
							[],
							[
								'prompt'=>'- Select child Category -',
								'class'=>'form-control select3',
							]
						)->label('Child Category') 
						?>						
						</span>
						<?= $form->field($model, 'name')->textInput(['maxlength' => true])->label("Please provide a title to your product:") ?>
						<?= $form->field($model, 'market_price')->textInput()->label("What is the Market price:") ?>
						<?= $form->field($model, 'price')->textInput()->label("At what price do you want to list it:") ?>
						 <?= $form->field($model, 'quantity')->textInput()->label("Quantity:") ?>			
					</div>
					<div class="col-md-6">
					   <div class="form-group">
						   <div class="form-group">
							   <label>Brand:*</label>
							   <select class="form-control">
								   <option>Aberocrombie</option>
								   <option>xyz</option>
							   </select>
						   </div>
					   </div>
					   <div class="form-group">
						   <div class="form-group">
							   <label>Please Choose A Color:*</label>
							   <select class="form-control">
								   <option>Assorted</option>
								   <option>xyz</option>
							   </select>
						   </div>
					   </div>
					   <div class="form-group">
						   <div class="form-group">
							   <label>Choose Appropriate Size:*</label>
							   <select class="form-control">
								   <option>10R</option>
								   <option>xyz</option>
							   </select>
						   </div>
					   </div>
					   <div class="form-group">
						   <div class="form-group">
							   <label>Fabric/material Type:*</label>
							   <select class="form-control">
								   <option>Acrylic Blend</option>
								   <option>xyz</option>
							   </select>
						   </div>
					   </div>
					   <div class="form-group">
						   <div class="form-group">
							   <label>Choose Appropriate Year:*</label>
							   <select class="form-control">
								   <option>2000</option>
								   <option>xyz</option>
							   </select>
						   </div>
					   </div>
					   <div class="form-group">
						   <div class="form-group">
							   <label>Style:*</label>
							   <select class="form-control">
								   <option>Checked</option>
								   <option>xyz</option>
							   </select>
						   </div>
					   </div>
					   <div class="form-group">
						   <div class="form-group">
							   <label>Neck:*</label>
							   <select class="form-control">
								   <option>Asymmetric</option>
								   <option>xyz</option>
							   </select>
						   </div>
					   </div>
					</div>
					<?= $form->field($model, 'description')->textarea(['rows' => 6])->label("Please write a description about your product:") ?>
					
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4 class="head4-red">optional parameters</h4>
					</div>
				   <div class="col-md-6">
					   <div class="img-box1">
						   <p>This image below is not your product image. It is a an image to help you give us the accurate measurements of your product.</p>
						   <img src="images/shift-dress.jpg">
					   </div>
				   </div>
				   <div class="col-md-6">
						<h4 class="head4-borderd">Please fill in the measurements (Inches) of your product:</h4>
						<div class="range-slide">
							<fieldset>
								<label>Sleeves:<span class="showval" id="ex12h-val">5</span></label>
								<input id="ex12h" type="text" data-slider-tooltip="hide">
							</fieldset>
						</div>
						<div class="range-slide">
						   <fieldset>
							   <label>Bust:<span class="showval" id="ex12i-val">5</span></label>
							   <input id="ex12i" type="text" data-slider-tooltip="hide">
						   </fieldset>
						</div>
						<div class="range-slide">
						   <fieldset>
							   <label>Waist:<span class="showval" id="ex12j-val">5</span></label>
							   <input id="ex12j" type="text" data-slider-tooltip="hide">
						   </fieldset>
						</div>
						<div class="range-slide">
						   <fieldset>
							   <label>Hip:<span class="showval" id="ex12k-val">5</span></label>
							   <input id="ex12k" type="text" data-slider-tooltip="hide">
						   </fieldset>
						</div>
						<div class="range-slide">
						   <fieldset>
							   <label>Length:<span class="showval" id="ex12l-val">5</span></label>
							   <input id="ex12l" type="text" data-slider-tooltip="hide">
						   </fieldset>
						</div>

				   </div>
				</div>
			</form>
		</div>
	</div>
<div class="product-form">

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
