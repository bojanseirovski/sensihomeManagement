<?php
/* @var $this ActuatorController */
/* @var $model Actuator */

$this->breadcrumbs=array(
	'Actuators'=>array('index'),
	'Add',
);
?>

<h1>Add Actuator</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
