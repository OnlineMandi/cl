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
<div class="select-category">

    <h1><?= Html::encode($this->title) ?></h1>

     <div class="admin-display-header">
		<h4>Step 1: Select category</h4>
	</div>
	<div class="admin-display-box">
		<div class="admin-form sm-input">
			<?php $form = ActiveForm::begin(['action' => 'add-product']); 
			?>
			<input type="hidden" name="step" value="sc">
				<div class="row">
					<div class="col-md-12">
						<?= $form->field($model, 'category[0]')->dropDownList(
							$model->getCategories(),
							[
								'prompt'=>'-Select Section-',
								'class'=>'form-control select0',
								'onchange'=> '
									if($(this).val()){
									  $.post( "'.Yii::$app->urlManager->createUrl('/seller/subcategories?id=').'"+$(this).val(), function( data ) {
									  $( "select#productform-category-1" ).html("<option value=\"\">- Select main category -</option>");
									  $( "select#productform-category-2" ).html("<option value=\"\">- Select sub-category -</option>");
									  $( "select#productform-category-3" ).html("<option value=\"\">- Select child category -</option>"); 
									  $("#dd").addClass("hidden");									  
									  for(var index in data.result){
										  if(!data.result.hasOwnProperty(index)){
											  continue;
										  }
										$( "select#productform-category-1" ).append("<option value="+index+">"+ data.result[index]+"</option>");  
									  }
									  
									});
									} else {
									  $( "select#productform-category-1" ).html("<option value=\"\">- Select main category -</option>");
									  $( "select#productform-category-2" ).html("<option value=\"\">- Select sub-category -</option>");
									  $( "select#productform-category-3" ).html("<option value=\"\">- Select child category -</option>"); 
									  $("#dd").addClass("hidden");
									}'

							]
						)->label('Select Section to List Product:') 
						?>
						<?= $form->field($model, 'category[1]')->dropDownList(
							[],
							[
								'prompt'=>'- Select main category -',
								'class'=>'form-control select1',
								'onchange'=> '
									if($(this).val()){
										$.post( "'.Yii::$app->urlManager->createUrl('/seller/subcategories?id=').'"+$(this).val(), function( data ) {
											$( "select#productform-category-2" ).html("<option value=\"\">- Select Sub-category -</option>");
											$( "select#productform-category-3" ).html("<option value=\"\">- Select child category -</option>");
											$("#dd").addClass("hidden");
											
											  for(var index in data.result){
												  if(!data.result.hasOwnProperty(index)){
													  continue;
												  }
												$( "select#productform-category-2" ).append("<option value="+index+">"+ data.result[index]+"</option>");  
											  }
											  
										});
									} else {
										$( "select#productform-category-2" ).html("<option value=\"\">- Select Sub-category -</option>");
										$( "select#productform-category-3" ).html("<option value=\"\">- Select child category -</option>");
										$("#dd").addClass("hidden");
									}'

							]
						)->label('Select Main Category') 
						?>
						
						<?= $form->field($model, 'category[2]')->dropDownList(
							[],
							[
								'prompt'=>'- Select Sub-category -',
								'class'=>'form-control select2',
								'onchange'=> '
									if($(this).val()){
										$.post( "'.Yii::$app->urlManager->createUrl('/seller/subcategories?id=').'"+$(this).val(), function( data ) {
										if($( ".field-productform-category-3").length){
											$( "select#productform-category-3" ).html("");
											element = $( ".field-productform-category-3");
										} else {
											$("#dd").html(element);
											$("#dd").addClass("hidden");
										}
										
										if(data.count){										
										  $( "select#productform-category-3" ).append("<option value=\"\">- Select Child Category -</option>");  
										  for(var index in data.result){
											  if(!data.result.hasOwnProperty(index)){
												  continue;
											  }
											$( "select#productform-category-3" ).append("<option value="+index+">"+ data.result[index]+"</option>");  
										  }
										  $("#dd").removeClass("hidden");
										} else {
											$( ".field-productform-category-3").remove();
										}
										  
										  
										});
									} else {
										if($( ".field-productform-category-3").length){
											$( "select#productform-category-3" ).html("");
											element = $( ".field-productform-category-3");
										} else {
											$("#dd").html(element);
											$("#dd").addClass("hidden");
										}
									}'
							]
						)->label('Select Sub Category') 
						?>
						<span id="dd" class="hidden">
						<?= $form->field($model, 'category[3]')->dropDownList(
							[],
							[
								'prompt'=>'- Select Child Category -',
								'class'=>'form-control select3', 
							]
						)->label('Select Child Category') 
						?>						
						</span>		
					</div>				
				</div>	
		</div>
	</div>
<div class="product-form">

    <div class="form-group">
        <?= Html::submitButton('Continue', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
