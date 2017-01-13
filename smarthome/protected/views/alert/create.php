<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'Rules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rule', 'url'=>array('index')),
	array('label'=>'Manage Rule', 'url'=>array('admin')),
);
?>

<h1>Create Rule</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>