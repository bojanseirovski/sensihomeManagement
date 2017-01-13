<?php
/* @var $this AlertController */
/* @var $model Alert */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'alert-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scheduled_on'); ?>
		<?php echo $form->textField($model,'scheduled_on'); ?>
		<?php echo $form->error($model,'scheduled_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'triggered_by'); ?>
		<?php // echo $form->textField($model,'triggered_by'); ?>
		<?php $sModel = new Sensor(); ?>
		<?php echo CHtml::dropDownList('Alert[triggered_by]',	$model->triggered_by,	$sModel->getSensorNameId() ); ?>
		<?php echo $form->error($model,'triggered_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trigger_value'); ?>
		<?php echo $form->textField($model,'trigger_value',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'trigger_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enabled'); ?>
		<?php // echo $form->textField($model,'enabled'); ?>
		<?php echo CHtml::checkBox('Alert[enabled]',$model->enabled); ?>
		<?php echo $form->error($model,'enabled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		   <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'Alert[date_created]',
                        'flat'=>true,
                        'options'=>array(
                            'dateFormat' => 'yy-mm-dd',
                            'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            'changeMonth'=>true,
                            'changeYear'=>true,
                            'yearRange'=>'2000:2099',
                            'minDate' => '2000-01-01',      // minimum date
                            'maxDate' => '2099-12-31',      // maximum date
                        ),
																								"value"=>$model->date_created,
                        'htmlOptions'=>array(
                            'style'=>''
                        ),
                    ));
                ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actuator_id'); ?>
		<?php // echo $form->textField($model,'actuator_id'); ?>
		<?php $aModel = new Actuator(); ?>
		<?php echo CHtml::dropDownList('Alert[triggered_by]',	$model->actuator_id,	$aModel->getActuatorNameId() ); ?>
		<?php echo $form->error($model,'actuator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actuator_state'); ?>
		<?php echo $form->textField($model,'actuator_state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'actuator_state'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->