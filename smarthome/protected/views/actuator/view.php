<?php
/* @var $this ActuatorController */
/* @var $model Actuator */

$this->breadcrumbs=array(
	'Actuators'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Actuator', 'url'=>array('index')),
	array('label'=>'New', 'url'=>array('create')),
	array('label'=>'Update this Actuator', 'url'=>array('update', 'id'=>$model->aid)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->aid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage All', 'url'=>array('admin')),
);
?>

<h1>Actuator "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'aid',
		'type'=>array(
						'label'=>'Type',
						'value'=>		Actuator::model()->getActuatorNameIdType($model->aid)['type_name']
		),
		'state',
		'name',
		'value_fields',
		'com_id',
		'system_id',
		'date_created',
	),
)); ?>
