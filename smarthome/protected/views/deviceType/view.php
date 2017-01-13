<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

$this->breadcrumbs=array(
	'Device Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DeviceType', 'url'=>array('index')),
	array('label'=>'Create DeviceType', 'url'=>array('create')),
	array('label'=>'Update DeviceType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeviceType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeviceType', 'url'=>array('admin')),
);
?>

<h1>View Device Type #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'description',
		'treshold',
		'theshold_state',
	),
)); ?>
