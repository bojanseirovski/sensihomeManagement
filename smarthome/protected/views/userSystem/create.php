<?php
/* @var $this UserSystemController */
/* @var $model UserSystem */

$this->breadcrumbs=array(
	'User Systems'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserSystem', 'url'=>array('index')),
	array('label'=>'Manage UserSystem', 'url'=>array('admin')),
);
?>

<h1>Create UserSystem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>