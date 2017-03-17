<?php
/* @var $this ActuatorController */
/* @var $data Actuator */
$typeName = '';
$system = '';
try {
    $actType = ActuatorType::model()->findByPk($data->type);
    $typeName = is_object($actType) ? $actType->getAttribute('type_name') : 'Actuator ID: ' . $data->aid;
    $sys = System::model()->findByPk($data->system_id);
    $system = is_object($sys) ? $sys->getAttribute('name') : '';
}
catch (Exception $e) {
    Yii::log($e->getMessage());
}
$devLink = CHtml::link(CHtml::encode($data->name), array('viewone', 'id' => $data->aid));
$devLink2 = CHtml::link(CHtml::encode($typeName), array('viewone', 'id' => $data->aid));
?>

<div class="view">
    <div>
	<h3>
	    <?= $devLink; ?>
	</h3>
    </div>
    <ul class="option-per-device">
	<li>
	    <a href="<?= $this->createAbsoluteUrl('/actuator/one/' . $data->aid) ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> History</a>
	</li>
	<li>
	    <a href="http://<?= $data->com_id; ?>/id/<?= $data->serial; ?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Go to device</a>
	</li>
	<li>
	    <a href="<?= $this->createAbsoluteUrl('/actuator/update/' . $data->aid) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
	</li>
	<li>
	    <a href="javascript:void(0);" class="del-item" data-id="<?= $data->aid; ?>" data-type="actuator"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
	</li>
    </ul>


    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('type')); ?>:</strong>
	<?= $devLink2; ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('state')); ?>:</strong>
	<?= CHtml::encode($data->state); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('name')); ?>:</strong>
	<?= CHtml::encode($data->name); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('com_id')); ?>:</strong>
	<?= CHtml::encode($data->com_id); ?>
    </div>

    <div>
	<strong><?= CHtml::encode($data->getAttributeLabel('value_fields')); ?>:</strong>
	<?= CHtml::encode($data->value_fields); ?>
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
