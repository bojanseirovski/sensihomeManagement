<?php
/* @var $this SensorController */
/* @var $model Sensor */

$this->breadcrumbs=array(
	'Sensors'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'Home', 'url'=>array('index')),
	array('label'=>'New Sensor', 'url'=>array('create')),
	array('label'=>'Update this Sensor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage All', 'url'=>array('admin')),
);
?>

<h1>Sensor "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'unit',
		'name',
		'value_fields',
		'com_id',
		'system_id',
		'date_created',
	),
)); ?>
