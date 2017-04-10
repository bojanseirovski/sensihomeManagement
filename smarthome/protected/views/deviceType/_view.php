<?php
/* @var $this DeviceTypeController */
/* @var $data DeviceType */
?>

<div class="view">
    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('type')); ?>:</strong>
	<?=CHtml::link(CHtml::encode($data->type), array('view', 'id'=>$data->id)) ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('description')); ?>:</strong>
	<?= CHtml::encode($data->description); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('treshold')); ?>:</strong>
	<?= CHtml::encode($data->treshold); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('theshold_state')); ?>:</strong>
	<?= CHtml::encode($data->theshold_state); ?>
    </div>
</div>
<hr/>
