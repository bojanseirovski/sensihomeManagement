<?php
/* @var $this AlertController */
/* @var $data Alert */
$baseUrl = Yii::app()->request->baseUrl;
$aname = $this->getActuatorNameAndId($data->aid)['name'];
$sname = $this->getSensorNameAndId($data->sid)['name'];
?>

<div class="view">
    <div>
        <h3>
            <?= CHtml::link(CHtml::encode($data->alname), ['view', 'id' => $data->alid]); ?>
        </h3>
    </div>

    <ul class="option-per-device">
        <li>
            <a href="<?= $this->createAbsoluteUrl('/actuator/one/' . $data->aid) ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Actuator</a>
        </li>
        <li>
            <a href="<?= $this->createAbsoluteUrl('/sensor/one/' . $data->sid) ?>"><i class="fa fa-tachometer " aria-hidden="true"></i> Sensor</a>
        </li>
        <li>
            <a href="<?= $this->createAbsoluteUrl('/alert/update/' . $data->alid) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
        </li>
        <li>
            <a href="javascript:void(0);" class="del-item" data-id="<?= $data->id; ?>" data-type="alert"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
        </li>
    </ul>

    <div>
        <strong><?= CHtml::encode($data->getAttributeLabel('action')); ?>:</strong>
        <?= CHtml::link(CHtml::encode($data->alname), array('view', 'id' => $data->alid)); ?>
    </div>

    <div>
        <strong><?= CHtml::encode($data->getAttributeLabel('scheduled_on')); ?>:</strong>
        <?= date('M d Y', strtotime($data->date)); ?>
    </div>

    <div>
        <strong><?= CHtml::encode($data->getAttributeLabel('aid')); ?>:</strong>
        <?= CHtml::link($aname, ['/actuator/one', 'id' => $data->aid]) ?>
    </div>

    <div>
        <strong><?= CHtml::encode($data->getAttributeLabel('sid')); ?>:</strong>
        <?= CHtml::link($sname, ['/sensor/one', 'id' => $data->sid]) ?>
    </div>

    <div>
        <strong><?= CHtml::encode($data->getAttributeLabel('astate')); ?>:</strong>
        <?= CHtml::encode($data->astate); ?>
    </div>

    <div>
        <strong><?= CHtml::encode($data->getAttributeLabel('date')); ?>:</strong>
        <?= $data->date; ?>
    </div>

</div>
