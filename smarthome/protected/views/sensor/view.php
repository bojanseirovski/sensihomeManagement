<?php
/* @var $this SensorController */
/* @var $model Sensor */

$this->breadcrumbs=array(
	'Sensors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus-square-o" aria-hidden="true"></i> New', 'url'=>array('create')),
	array('label'=>'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="fa fa-list" aria-hidden="true"></i>Manage', 'url'=>array('list')),
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
