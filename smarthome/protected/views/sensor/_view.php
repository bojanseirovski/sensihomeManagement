<?php
$aLabel = CHtml::encode($data->name);
$typeName = '';
$system = '';

try {
    $sensorType = SensorType::model()->findByPk($data->type);
    $typeName = is_object($sensorType) ? $sensorType->getAttribute('type_name') : 'Sensor ID :' . $data->id;
    $sys = System::model()->findByPk($data->system_id);
    $system = is_object($sys) ? $sys->getAttribute('name') : '';
}
catch (Exception $e) {
    Yii::log($e->getMessage());
}
$devLink = CHtml::link(CHtml::encode($data->name), array('view', 'id' => $data->id));
$devLink2 = CHtml::link(CHtml::encode($typeName), array('view', 'id' => $data->id));
?>


<div class="view">

    <div>
	<h3>
	    <?= $devLink; ?>
	</h3>
    </div>

    <ul class="option-per-device">
	<li>
	    <a href="<?= $this->createAbsoluteUrl('/sensor/one/' . $data->id) ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> History</a>
	</li>
	<li>
	    <a href="http://<?= $data->com_id; ?>/id/<?= $data->serial; ?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Go to device</a>
	</li>
	<li>
	    <a href="<?= $this->createAbsoluteUrl('/sensor/update/' . $data->id) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
	</li>
	<li>
	    <a href="javascript:void(0);" class="del-item" data-id="<?= $data->id; ?>" data-type="sensor"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
	</li>
    </ul>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('type')); ?>:</strong>
	<?= $devLink2; ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('unit')); ?>:</strong>
	<?= CHtml::encode($data->unit); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('value_fields')); ?>:</strong>
	<?= CHtml::encode($data->value_fields); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('com_id')); ?>:</strong>
	<?= CHtml::encode($data->com_id); ?>
    </div>

    <div>
	<strong>System :</strong>
	<?= CHtml::encode($system); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('date_created')); ?>:</strong>
	<?= date('M d Y', strtotime($data->date_created)); ?>
    </div>

</div>
<hr/>
