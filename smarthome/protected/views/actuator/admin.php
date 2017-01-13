<?php
/* @var $this ActuatorController */
/* @var $model Actuator */

$this->breadcrumbs=array(
	'Actuators'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List All', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> New actuator', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#actuator-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Actuators</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'actuator-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'type',
		'state',
		'name',
		'com_id',
		'system_id',
		/*
		'date_created',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
