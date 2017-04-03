<?php
$devData	=	[];
$isSensor	=	$data->sensor	==	1;
if	($isSensor)	{
				$devData	=	Sensor::model()->findByPk($data->sensor_id);
}
else	{
				$devData	=	Actuator::model()->findByPk($data->sensor_id);
}
$urlType	=	$isSensor	?	"sensor"	:	"actuator";
?>
<hr/>
<div class="row view">

    <div class="col-md col-md-3">
								<strong><?=	CHtml::encode($data->getAttributeLabel('sensor_id'));	?>:</strong>
								<a href="<?=	$this->createAbsoluteUrl('/'	.	$urlType	.	'/one/'	.	$data->sensor_id)	?>">
												<?=	CHtml::encode(isset($devData->name)?$devData->name:"");	?>
								</a>
    </div>

    <div class="col-md col-md-2">
								<strong><?=	CHtml::encode($data->getAttributeLabel('value'));	?>:</strong>
								<?=	CHtml::encode($data->value);	?>
    </div>

    <div class="col-md col-md-2">
								<strong><?=	CHtml::encode($data->getAttributeLabel('date_measured'));	?>:</strong>
								<?=	CHtml::encode(date('Y M d',	strtotime($data->date_measured)));	?>
    </div>

    <div class="col-md col-md-2">
								<strong><?=	CHtml::encode($data->getAttributeLabel('message'));	?>:</strong>
								<?=	CHtml::encode($data->message);	?>
    </div>

    <div class="col-md col-md-2">
								<strong>Type :</strong>
								<?=	$data->sensor	==	0	?	"Actuator"	:	"Sensor";	?>
    </div>
</div>
