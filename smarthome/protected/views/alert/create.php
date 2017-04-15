<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'Rules'=>array('index'),
	'Create',
);
?>

<script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/smarthome/alert/list.js"></script>
<h1>Create Rule</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>