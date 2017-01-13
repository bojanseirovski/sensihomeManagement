<?php
/* @var $this AlertController */
/* @var $model Alert */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'scheduled_on'); ?>
		<?php echo $form->textField($model,'scheduled_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'triggered_by'); ?>
		<?php echo $form->textField($model,'triggered_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trigger_value'); ?>
		<?php echo $form->textField($model,'trigger_value',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enabled'); ?>
		<?php echo $form->textField($model,'enabled'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actuator_id'); ?>
		<?php echo $form->textField($model,'actuator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actuator_state'); ?>
		<?php echo $form->textField($model,'actuator_state',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->