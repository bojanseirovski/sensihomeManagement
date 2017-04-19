<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
	'id' => 'user-form',
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
	<?= $form->labelEx($model, 'username'); ?>
	<?= $form->textField($model, 'username', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
	<?= $form->error($model, 'username'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'password'); ?>
	<?= $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
	<?= $form->error($model, 'password'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'name'); ?>
	<?= $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
	<?= $form->error($model, 'name'); ?>
    </div>

    <div class="row">
	<?= $form->labelEx($model, 'notify'); ?>
	<?= CHtml::checkBox('User[notify]', $model->notify); ?>
	<?= $form->error($model, 'notify'); ?>
    </div>

    <div class="row buttons">
	<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn btn-lg btn-success")); ?>
	<?= CHtml::link('Cancel', ['/user/' . $model->id], ['class' => 'btn btn-lg btn-danger']) ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
