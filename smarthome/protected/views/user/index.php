<?php
$baseUrl	=	Yii::app()->request->baseUrl;
?>
<link  rel="stylesheet" type="text/css" href="<?=	$baseUrl;	?>/css/smarthome/alert/index.css" />
<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus-square-o" aria-hidden="true"></i> Create User', 'url'=>array('create')),
	array('label'=>'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage User', 'url'=>array('admin')),
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>