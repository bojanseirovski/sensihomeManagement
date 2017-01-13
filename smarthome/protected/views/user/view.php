<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
//	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update account', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete account', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Details for "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'username',
		array(
                    'name'=> 'password',
                    'type'=>'raw',
                    'value'=>'**********'
                ),
		'name',
	),
)); ?>

<hr/>

<h2>System details</h2>
<div id="system_status">
    <a href="<?= $this->createUrl('system/usersumary');?>">Status</a>
</div>
<div id="system_details">
    <a href="<?= $this->createUrl('system/'.Yii::app()->session['system_id']);?>">Details</a>
</div>

<hr/>
