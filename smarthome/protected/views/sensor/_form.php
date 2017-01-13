<?php
/* @var $this SensorController */
/* @var $model Sensor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sensor-form',
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
		<?php // echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
		<?php $sType = new SensorType(); ?>
		<?php echo CHtml::dropDownList('Sensor[type]',$model->type,$sType->getTypeIdName()); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit'); ?>
		<?php echo $form->textField($model,'unit',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value_fields'); ?>
		<?php echo $form->textField($model,'value_fields',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'value_fields'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'com_id'); ?>
		<?php echo $form->textField($model,'com_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'com_id'); ?>
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
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'Sensor[date_created]',
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
                        'htmlOptions'=>array(
                            'style'=>''
                        ),
                    ));
                ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->