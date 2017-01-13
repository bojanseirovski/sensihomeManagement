<?php
/* @var $this ActuatorController */
/* @var $model Actuator */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actuator-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'com_id'); ?>
		<?php echo $form->textField($model,'com_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'com_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value_fields'); ?>
		<?php echo $form->textField($model,'value_fields',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'value_fields'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'system_id'); ?>
		<?php echo $form->textField($model,'system_id'); ?>
		<?php echo $form->error($model,'system_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serial'); ?>
		<?php echo $form->textField($model,'serial'); ?>
		<?php echo $form->error($model,'serial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->