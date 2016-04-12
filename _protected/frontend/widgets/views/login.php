<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<h3>LOGIN</h3>
<span>If you have an account with us, please log in.</span>
	<?php $form = ActiveForm::begin([
		'id' => 'login-form',
		'action' => ['site/login'],		
		'enableAjaxValidation'   => true,
		'enableClientValidation' => false,
		'validateOnBlur'         => false,
		'validateOnType'         => false,
		'validateOnChange'       => false,		
		]) 
	?>
	<?php //-- use email or username field depending on model scenario --// ?>
	<?php if ($model->scenario === 'lwe'): ?>
	
		<?= $form->field($model, 'email',[
		'inputOptions' => [
			'placeholder' => 'Email',
		],
		'template' => '<div class="form-group field-login-form-login required">{input}{error}{hint}</div>'
		]) ?> 
		
	<?php else: ?>
		<?= $form->field($model, 'username',[
		'inputOptions' => [
			'placeholder' => 'Username',
		],
		'template' => '<div class="form-group field-login-form-login required">{input}{error}{hint}</div>'
		]) ?> 
	<?php endif ?>
	
	<?= $form->field($model, 'password',[
	'inputOptions' => [
		'placeholder' => 'Password',
	],
	'template' => '<div class="form-group field-login-form-login required">{input}{error}{hint}</div>'
	])->passwordInput() ?> 
	
	<div class="form-group field-login-form-login required">
		<?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4'])->label('Remember me next time'); ?> 	
	</div>		
	<?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

<?php ActiveForm::end(); ?>

<a href="#">Forgot password?</a>
<a href="javascript:void(0);" data-popup-id="signup">Register</a>