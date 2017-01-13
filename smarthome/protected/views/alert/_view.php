<?php
/* @var $this AlertController */
/* @var $data Alert */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
	<?php // echo CHtml::encode($data->action); ?>
	<?php echo CHtml::link(CHtml::encode($data->action), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scheduled_on')); ?>:</b>
	<?php echo CHtml::encode($data->scheduled_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('triggered_by')); ?>:</b>
	<?php // echo CHtml::encode($data->triggered_by); ?>
	<?php echo CHtml::encode($this->getSensorNameAndId($data->triggered_by)['name']); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trigger_value')); ?>:</b>
	<?php echo CHtml::encode($data->trigger_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enabled')); ?>:</b>
	<?php echo CHtml::encode($data->enabled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('actuator_id')); ?>:</b>
	<?php echo CHtml::encode($data->actuator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actuator_state')); ?>:</b>
	<?php echo CHtml::encode($data->actuator_state); ?>
	<br />

	*/ ?>

</div>