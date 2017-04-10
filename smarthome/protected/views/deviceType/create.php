<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

$this->breadcrumbs=array(
	'Device Types'=>array('index'),
	'Add',
);
?>

<h1>Add Device Type</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
