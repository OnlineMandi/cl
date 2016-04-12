
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="admin-display-header">
	<h4>Account Information </h4>
	<a class="edit_admin_display" target-class="account-inf" attr-type="edit" href="javascript:void(0);">Edit</a>
</div>
<div class="admin-display-box account-inf">
	<div class="admin-list">
		<?php $form = ActiveForm::begin([
			'id' => 'account-information',
			'action' => ['account/information'],
			'enableAjaxValidation'   => true,
			'options' => ['onsubmit'=>'return false;']
			]) 
		?>		
			<div class="readable">
				<p>First Name		<span><?= $profile->fname ?></span></p>
				<p>Last Name		<span ><?= $profile->lname ?></span></p>
				<p>Email	<span ><?= $model->email ?></span></p>
				<p>mobile	<span><?= $profile->phone ?></span></p>
				<p>Gender	<span ><?= $profile->gender ?></span></p>
			</div>
			<div class="editable">
				<?= $form->field($profile, 'fname',[
					'template' => '<div class="form-group col-sm-6">{label}{input}{error}{hint}</div>'
				]) ?> 	
				<?= $form->field($profile, 'lname',[
					'template' => '<div class="form-group col-sm-6">{label}{input}{error}{hint}</div>'
				]) ?> 		
				<?= $form->field($profile, 'phone',[
					'template' => '<div class="form-group col-sm-6">{label}{input}{error}{hint}</div>'
				]) ?> 		

				<?= $form->field($profile, 'gender',['template' => '<div class="form-group col-sm-6">{label}{input}{error}{hint}</div>','options'=>['class'=>'col-md-6']])->dropDownList(['1' => 'Female','0' => 'male'], ['prompt'=>'Select gender','class'=>'form-control select2 required'] ) ?>	
			</div>	
		
	<?php ActiveForm::end(); ?>		
	</div>
</div>
<div class="admin-display-box editable">
	<div class="admin-form">
		<div class="row">


			

				<?= $form->field($profile, 'fname',[
					'template' => '<div class="form-group col-sm-6">{label}{input}{error}{hint}</div>'
				]) ?> 	
				<?= $form->field($profile, 'lname',[
					'template' => '<div class="form-group col-sm-6">{label}{input}{error}{hint}</div>'
				]) ?> 		
				<?= $form->field($profile, 'phone',[
					'template' => '<div class="form-group col-sm-6">{label}{input}{error}{hint}</div>'
				]) ?> 		

				<?= $form->field($profile, 'gender',['template' => '<div class="form-group col-sm-6">{label}{input}{error}{hint}</div>','options'=>['class'=>'col-md-6']])->dropDownList(['1' => 'Female','0' => 'male'], ['prompt'=>'Select gender','class'=>'form-control select2 required'] ) ?>			

				<div class="form-group col-sm-12">
					<fieldset>
						<input id="brd-3" type="checkbox">
						<label for="brd-3">
							<span></span>
							Check here for Password
						</label>
					</fieldset>
				</div>

		</div>
	</div>
</div>
<div class="admin-display-header">
	<h4>Bank Details </h4>
	<a class="edit_admin_display" target-class="bank-inf" attr-type="edit" href="javascript:void(0);">Edit</a>
</div>
<div class="admin-display-box bank-inf">
	<div class="admin-list">
		<?php $form = ActiveForm::begin([
			'id' => 'bank-information',
			'action' => ['account/bank-information'],
			'enableAjaxValidation'   => true,
			]) 
		?>		
		<p>Account Full Name <span>Manpreet Singh</span></p>
		<p>Bank Name <span>State bank of india</span></p>
		<p>Bank Account number <span>0078139506</span></p>
		<p>Account type <span>Saving</span></p>
		<p>IFSC Code <span>cd4953</span></p>
		<p>Branch City <span>Rajpura</span></p>

		
		<?php ActiveForm::end(); ?>				
	</div>
</div>