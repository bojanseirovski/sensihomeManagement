<?php
/* @var $this SystemController */
/* @var $data System */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('prim_key')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->prim_key), array('view', 'id'=>$data->prim_key)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sensor_count')); ?>:</b>
	<?php echo CHtml::encode($data->sensor_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key')); ?>:</b>
	<?php echo CHtml::encode($data->key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('outer_key')); ?>:</b>
	<?php echo CHtml::encode($data->outer_key); ?>
	<br />


</div>