<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'Alerts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>
<script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/smarthome/alert/list.js"></script>
<h1>Update <strong><?php echo $model->action; ?></strong></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
