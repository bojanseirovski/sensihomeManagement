<?php
/* @var $this SystemController */
/* @var $model System */

$this->breadcrumbs=array(
	'System'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List System', 'url'=>array('index')),
//	array('label'=>'Create System', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->prim_key)),
//	array('label'=>'Delete System', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->prim_key),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage System', 'url'=>array('admin')),
);
?>

<h1>"<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'name',
		'sensor_count',
		'key',
		'outer_key',
		'prim_key',
	),
)); ?>
