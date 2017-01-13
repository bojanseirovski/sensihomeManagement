<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

$this->breadcrumbs=array(
	'Device Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeviceType', 'url'=>array('index')),
	array('label'=>'Create DeviceType', 'url'=>array('create')),
	array('label'=>'View DeviceType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeviceType', 'url'=>array('admin')),
);
?>

<h1>Update DeviceType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>