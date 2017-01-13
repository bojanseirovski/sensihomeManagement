<?php
/* @var $this SystemController */
/* @var $model System */

$this->breadcrumbs=array(
	'Systems'=>array('index'),
	$model->name=>array('view','id'=>$model->prim_key),
	'Update',
);

$this->menu=array(
	array('label'=>'List System', 'url'=>array('index')),
	array('label'=>'Create System', 'url'=>array('create')),
	array('label'=>'View System', 'url'=>array('view', 'id'=>$model->prim_key)),
	array('label'=>'Manage System', 'url'=>array('admin')),
);
?>

<h1>Update System <?php echo $model->prim_key; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>