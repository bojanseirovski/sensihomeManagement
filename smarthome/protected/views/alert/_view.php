<?php
/* @var $this AlertController */
/* @var $data Alert */
$baseUrl = Yii::app()->request->baseUrl;
$aname = $this->getActuatorNameAndId($data->actuator_id)['name'];
$sname = $this->getSensorNameAndId($data->triggered_by)['name'];
?>

<div class="view">
    <div>
	<h3>
	    <?= CHtml::link(CHtml::encode($data->action), ['view', 'id' => $data->id]); ?>
	</h3>
    </div>

    <ul class="option-per-device">
	<li>
	    <a href="<?= $this->createAbsoluteUrl('/actuator/one/' . $data->actuator_id) ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Actuator</a>
	</li>
	<li>
	    <a href="<?= $this->createAbsoluteUrl('/sensor/one/' . $data->triggered_by) ?>"><i class="fa fa-tachometer " aria-hidden="true"></i> Sensor</a>
	</li>
	<li>
	    <a href="<?= $this->createAbsoluteUrl('/alert/update/' . $data->id) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
	</li>
	<li>
	    <a href="javascript:void(0);" class="del-item" data-id="<?= $data->id; ?>" data-type="alert"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
	</li>
    </ul>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('action')); ?>:</strong>
	<?= CHtml::link(CHtml::encode($data->action), array('view', 'id' => $data->id)); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('scheduled_on')); ?>:</strong>
	<?= date('M d Y', strtotime($data->scheduled_on)); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('actuator_id')); ?>:</strong>
	<?= CHtml::link($aname,['/actuator/one', 'id' => $data->actuator_id]) ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('triggered_by')); ?>:</strong>
	<?= CHtml::link($sname,['/sensor/one', 'id' => $data->triggered_by]) ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('trigger_value')); ?>:</strong>
	<?= CHtml::encode($data->trigger_value); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('enabled')); ?>:</strong>
	<?= ($data->enabled == 1) ? 'yes' : 'no'; ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('date_created')); ?>:</strong>
	<?= date('M d Y', strtotime($data->date_created)); ?>
    </div>
</div>
