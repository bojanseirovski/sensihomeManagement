<?php
/* @var $this SystemController */
/* @var $model System */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'system-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php // echo $form->labelEx($model,'id'); ?>
		<?php echo $form->hiddenField($model,'id'); ?>
		<?php // echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sensor_count'); ?>
		<?php echo $form->textField($model,'sensor_count'); ?>
		<?php echo $form->error($model,'sensor_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key'); ?>
		<?php echo $form->textField($model,'key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'outer_key'); ?>
		<?php echo $form->textField($model,'outer_key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'outer_key'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->