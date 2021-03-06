<?php
/* @var $this AlertController */
/* @var $model Alert */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'alert-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <?= $form->labelEx($model, 'action'); ?>
        <?= $form->textField($model, 'action', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?= $form->error($model, 'action'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'scheduled_on'); ?>
        <?= $form->textField($model, 'scheduled_on', ['class' => 'form-control']); ?>
        <?= $form->error($model, 'scheduled_on'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'is_daily'); ?>
        <?php //= $form->textField($model, 'is_daily', ['class' => 'form-control']); ?>
	<?= CHtml::checkBox('Alert[is_daily]', $model->is_daily); ?>
        <?= $form->error($model, 'is_daily'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'triggered_by'); ?>
        <?php $sModel = new Sensor(); ?>
        <?= CHtml::dropDownList('Alert[triggered_by]', $model->triggered_by, $sModel->getSensorNameId(), ['class' => 'form-control']); ?>
        <?= $form->error($model, 'triggered_by'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'trigger_value'); ?>
        <?= $form->textField($model, 'trigger_value', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?= $form->error($model, 'trigger_value'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'enabled'); ?>
        <?php // echo $form->textField($model,'enabled'); ?>
        <?= CHtml::checkBox('Alert[enabled]', $model->enabled); ?>
        <?= $form->error($model, 'enabled'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'date_created'); ?>
        <?= isset($model->date_created) ? date('M d Y', strtotime($model->date_created)) : ''; ?>
        <?= $form->error($model, 'date_created'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'actuator_id'); ?>
        <?php $aModel = new Actuator(); ?>
        <?= CHtml::dropDownList('Alert[actuator_id]', $model->actuator_id, $aModel->getActuatorNameId(), ['class' => 'form-control']); ?>
        <?= $form->error($model, 'actuator_id'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'actuator_state'); ?>
        <?= $form->textField($model, 'actuator_state', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?= $form->error($model, 'actuator_state'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'notify'); ?>
        <?= CHtml::checkBox('Alert[notify]', $model->notify); ?>
        <?= $form->error($model, 'notify'); ?>
    </div>

    <div class="row buttons">
        <?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn btn-lg btn-success")); ?>
        <?= CHtml::link('Cancel', [$this->prevUrl], ['class' => 'btn btn-lg btn-danger']) ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
