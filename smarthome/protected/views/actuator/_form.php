<?php
/* @var $this ActuatorController */
/* @var $model Actuator */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
	'id' => 'actuator-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?= $form->errorSummary($model); ?>

    <div class="row">
	<?= $form->labelEx($model, 'type'); ?>
	<?php // echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
	<?php $aType = new ActuatorType(); ?>
	<?= CHtml::dropDownList('Actuator[type]', $model->type, $aType->getTypeIdName(), ['class' => 'form-control']); ?>
	<?= $form->error($model, 'type'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'state'); ?>
	<?= $form->textField($model, 'state', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
	<?= $form->error($model, 'state'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'name'); ?>
	<?= $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
	<?= $form->error($model, 'name'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'com_id'); ?>
	<?= $form->textField($model, 'com_id', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
	<?= $form->error($model, 'com_id'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'value_fields'); ?>
	<?= $form->textField($model, 'value_fields', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
	<?= $form->error($model, 'value_fields'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'system_id'); ?>
	<?= $form->textField($model, 'system_id', ['class' => 'form-control']); ?>
	<?= $form->error($model, 'system_id'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'serial'); ?>
	<?= $form->textField($model, 'serial', ['class' => 'form-control']); ?>
	<?= $form->error($model, 'serial'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'date_created'); ?>
	<?= isset($model->date_created) ? date('M d Y', strtotime($model->date_created)) : ''; ?>
	<?= $form->error($model, 'date_created'); ?>
    </div>

    <div class="row buttons">
	<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn btn-lg btn-success")); ?>
	<?= CHtml::link('Cancel', ['/actuator/list'], ['class' => 'btn btn-lg btn-danger']) ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
