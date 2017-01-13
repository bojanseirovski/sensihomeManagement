<?php
/* @var $this UserSystemController */
/* @var $model UserSystem */

$this->breadcrumbs=array(
	'User Systems'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserSystem', 'url'=>array('index')),
	array('label'=>'Create UserSystem', 'url'=>array('create')),
	array('label'=>'View UserSystem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserSystem', 'url'=>array('admin')),
);
?>

<h1>Update UserSystem <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>