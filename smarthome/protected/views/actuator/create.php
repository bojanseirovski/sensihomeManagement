<?php
/* @var $this ActuatorController */
/* @var $model Actuator */

$this->breadcrumbs=array(
	'Actuators'=>array('index'),
	'Add',
);

//$this->menu=array(
//	array('label'=>'List Actuator', 'url'=>array('index')),
//	array('label'=>'Manage Actuator', 'url'=>array('admin')),
//);
?>

<h1>Add Actuator</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
