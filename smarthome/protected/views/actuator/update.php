<?php
/* @var $this ActuatorController */
/* @var $model Actuator */

$this->breadcrumbs=array(
	'Actuators'=>array('index'),
	$model->name=>array('view','id'=>$model->aid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actuator', 'url'=>array('index')),
	array('label'=>'Create Actuator', 'url'=>array('create')),
	array('label'=>'View Actuator', 'url'=>array('view', 'id'=>$model->aid)),
	array('label'=>'Manage Actuator', 'url'=>array('admin')),
);
?>

<h1>Update Actuator "<?php echo $model->name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>