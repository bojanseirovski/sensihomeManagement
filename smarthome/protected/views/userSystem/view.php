<?php
/* @var $this UserSystemController */
/* @var $model UserSystem */

$this->breadcrumbs=array(
	'User Systems'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserSystem', 'url'=>array('index')),
	array('label'=>'Create UserSystem', 'url'=>array('create')),
	array('label'=>'Update UserSystem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserSystem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserSystem', 'url'=>array('admin')),
);
?>

<h1>View UserSystem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'system_id',
	),
)); ?>
