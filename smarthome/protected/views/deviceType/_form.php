<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'device-type-form',
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
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'treshold'); ?>
		<?php echo $form->textField($model,'treshold',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'treshold'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'theshold_state'); ?>
		<?php echo $form->textField($model,'theshold_state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'theshold_state'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->