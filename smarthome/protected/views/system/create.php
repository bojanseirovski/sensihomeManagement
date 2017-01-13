<?php
/* @var $this SystemController */
/* @var $model System */

$this->breadcrumbs=array(
	'Systems'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List System', 'url'=>array('index')),
	array('label'=>'Manage System', 'url'=>array('admin')),
);
?>

<h1>Create System</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>