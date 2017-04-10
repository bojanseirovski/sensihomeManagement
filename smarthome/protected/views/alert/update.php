<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'Alerts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update <strong><?php echo $model->action; ?></strong></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
