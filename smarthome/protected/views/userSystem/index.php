<?php
/* @var $this UserSystemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Systems',
);

$this->menu=array(
	array('label'=>'Create UserSystem', 'url'=>array('create')),
	array('label'=>'Manage UserSystem', 'url'=>array('admin')),
);
?>

<h1>User Systems</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
