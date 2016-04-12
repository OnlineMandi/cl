<?php 
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerJs('
    $("#closet-name").hide();
    $("#profile-is_seller").change(function() {
		if ($("#profile-is_seller").is(":checked")) {
			$("#closet-name").show();
		}else{
			$("#closet-name").hide();
		}
	});
');
?>

<h3>Register</h3>

    

	<?php $form = ActiveForm::begin([
		'id' => 'registeration-form',
		'action' => ['site/signup'],
		'enableAjaxValidation'   => true,
		'enableClientValidation' => false,
		'validateOnBlur'         => false,
		'validateOnType'         => false,
		'validateOnChange'       => false,		
		]) 
	?>	
	
	<div class="row">
		<?= $form->field($profile, 'fname',[
			'inputOptions' => [
				'placeholder' => 'First Name',
			],
			'template' => '<div class="col-md-6 col-xs-12">{input}{error}{hint}</div>'
		])->label(false) ?> 
		
		<?= $form->field($profile, 'lname',[
		'inputOptions' => [
			'placeholder' => 'Lastname',
		],
		'template' => '<div class="col-md-6 col-xs-12">{input}{error}{hint}</div>'
		])->label(false) ?> 
		<?= $form->field($model, 'username',[
		'inputOptions' => [
			'placeholder' => 'Username',
		],
		'template' => '<div class="col-md-6 col-xs-12">{input}{error}{hint}</div>'
		])->label(false) ?> 
		<?= $form->field($model, 'email',[
		'inputOptions' => [
			'placeholder' => 'Email',
		],
		'template' => '<div class="col-md-6 col-xs-12">{input}{error}{hint}</div>'
		])->label(false) ?> 	
		<?= $form->field($profile, 'phone',[
		'inputOptions' => [
			'placeholder' => 'Phone',
		],
		'template' => '<div class="col-md-6 col-xs-12">{input}{error}{hint}</div>'
		])->label(false) ?> 
		<?= $form->field($profile, 'gender',['options'=>['class'=>'col-md-6']])->dropDownList(['1' => 'Female','0' => 'male'], ['prompt'=>'Select gender','class'=>'form-control select2 required'] )->label(false); ?>			


		<?= $form->field($profile, 'is_seller', [
			'template' => "<div class='col-lg-6'>{input}</div>",
		])->checkbox([],false)->label(); ?>
		
		<?= $form->field($closet, 'name',[
		'inputOptions' => [
			'placeholder' => 'Closet Name',
		],
		'template' => '<div class="col-md-6 col-xs-12">{input}{error}{hint}</div>'
		])->label(false); ?> 
		<?= $form->field($model, 'password',[
		'inputOptions' => [
			'placeholder' => 'Password',
		],
		'template' => '<div class="col-xs-12">{input}{error}{hint}</div>'
		])->widget(PasswordInput::classname(), [])->label(false) ?> 
		
	</div>
	<?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>


<?php ActiveForm::end(); ?>

<?php /*if ($model->scenario === 'rna'): ?>
	<div style="color:#666;margin:1em 0">
		<i>*<?= Yii::t('app', 'We will send you an email with account activation link.') ?></i>
	</div>
<?php endif */ ?>

<span>If you have an account with us, please <a href="javascript:void(0);" data-popup-id="login">Login</a>.</span>
