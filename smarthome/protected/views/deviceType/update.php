<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

$this->breadcrumbs=array(
	'Device Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update "<?php echo $model->type; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
