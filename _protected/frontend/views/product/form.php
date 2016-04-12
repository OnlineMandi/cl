<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$js = <<<JS
// get the form id and set the event
$('form#{$model->formName()}').on('beforeSubmit', function(e) {
	var form = $(this);
	if (form.find('.has-error').length) {
	  return false;
	}
	// submit form
	$.ajax({
		url: form.attr('action'),
		type: 'post',
		data: form.serialize(),
		success: function (response) {						
			if(response.type == 'success'){
				$('form#{$model->formName()}').trigger('reset');
				$('.form-success').html(response.message);
			}else{						
				$.each( response, function( key, value ) {
					$('#'+key).parent().removeClass('has-success').addClass('has-error');
					$('#'+key).parent().find('.help-block').html(value);
				});												
			}					
		}
	});
	return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;
 
$this->registerJs($js);
?>

<?php $form = ActiveForm::begin([
	'action'=>'/product/comment',
	'id'     => $model->formName(),
	'enableAjaxValidation'   => false,
]); ?>

	<?= $form->field($model, 'user_id')->hiddenInput()->label(false); ?>				
	<?= $form->field($model, 'product_id')->hiddenInput()->label(false); ?>

	<div class="form-group">
		<?= $form->field($model, 'comment')->textArea(['rows' => '3','class' => 'form-control'])->label("Your Review") ?>	
	</div>
	<?= Html::submitButton('Submit', ['class' => 'btn btn-default', 'name' => 'comment-button']) ?>
	<div class="success form-success" ></div>
<?php ActiveForm::end(); ?>  