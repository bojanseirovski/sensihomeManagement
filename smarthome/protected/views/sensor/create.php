<?php
/* @var $this SensorController */
/* @var $model Sensor */

$this->breadcrumbs=array(
	'Sensors'=>array('index'),
	'Add',
);

//$this->menu=array(
//	array('label'=>'List Sensor', 'url'=>array('index')),
//	array('label'=>'Manage Sensor', 'url'=>array('admin')),
//);
?>

<h1>Add Sensor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
