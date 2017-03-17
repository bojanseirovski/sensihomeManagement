<?php
$baseUrl	=	Yii::app()->request->baseUrl;
?>
<link  rel="stylesheet" type="text/css" href="<?=	$baseUrl;	?>/css/smarthome/alert/index.css" />
<?php
/* @var $this AlertController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs	=	array(
				'Rules',
);

$this->menu	=	array(
				array('label'	=>	'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> New rule',	'url'	=>	array('create')),
				array('label'	=>	'<i class="fa fa-file-text-o" aria-hidden="true"></i> Manage',	'url'	=>	array('admin')),
);
?>

<h1>Rules</h1>

<?php
$this->widget('zii.widgets.CListView',	array(
				'dataProvider'	=>	$dataProvider,
				'itemView'	=>	'_view',
));
?>
