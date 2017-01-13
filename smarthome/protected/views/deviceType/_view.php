<?php
/* @var $this DeviceTypeController */
/* @var $data DeviceType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('treshold')); ?>:</b>
	<?php echo CHtml::encode($data->treshold); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theshold_state')); ?>:</b>
	<?php echo CHtml::encode($data->theshold_state); ?>
	<br />


</div>