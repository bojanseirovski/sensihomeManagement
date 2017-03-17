<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-list" aria-hidden="true"></i> List Users', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-plus-square-o" aria-hidden="true"></i> New User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Update User settings <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
