<?php
$devData = [];
$isSensor = $data->sensor == 1;
if ($isSensor) {
    $devData = Sensor::model()->findByPk($data->sensor_id);
}
else {
    $devData = Actuator::model()->findByPk($data->sensor_id);
}
$urlType = $isSensor ? "sensor" : "actuator";
?>
<hr/>
<div class="row view">

    <div class="col-md col-md-3">
	<a href="<?= $this->createAbsoluteUrl('/' . $urlType . '/one/' . $data->sensor_id) ?>">
	    <?= CHtml::encode(isset($devData->name) ? $devData->name : ""); ?>
	</a>
    </div>

    <div class="col-md col-md-2">
	<?= CHtml::encode($data->value); ?>
    </div>

    <div class="col-md col-md-2">
	<?= CHtml::encode(date('Y M d', strtotime($data->date_measured))); ?>
    </div>

    <div class="col-md col-md-2">
	<?= CHtml::encode($data->message); ?>
    </div>

    <div class="col-md col-md-2">
	<?= $data->sensor == 0 ? "Actuator" : "Sensor"; ?>
    </div>
</div>
