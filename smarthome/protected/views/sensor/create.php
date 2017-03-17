<?php
/* @var $this SensorController */
/* @var $model Sensor */

$this->breadcrumbs=array(
	'Sensors'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List Sensor', 'url'=>array('index')),
//	array('label'=>'Manage Sensor', 'url'=>array('admin')),
//);
?>

<h1>Create Sensor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>