<?php
/* @var $this RuleController */
/* @var $model Rule */

$this->breadcrumbs=array(
	'Rules'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'New Rule', 'url'=>array('create')),
	array('label'=>'Update this Rule', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete this Rule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rules', 'url'=>array('admin')),
);
?>

<h1>Rule :<?php echo $model->action; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'action',
		'scheduled_on',
		'triggered_by'=>array(
						'label'=>'Triggered by',
						'type'=>'raw',
						"value"=>		CHtml::link($this->getSensorNameAndId($model->triggered_by)['name'],	Yii::app()->baseUrl."/sensor/one/".$model->triggered_by)
		),
		'trigger_value',
		'enabled',
		'date_created',
		'actuator_id'=>array(
						"label"=>"Actuator",
						'type'=>'raw',
						"value"=>		CHtml::link($this->getActiatorNameAndId($model->actuator_id)['name'],	Yii::app()->baseUrl."/actuator/viewone/".$model->actuator_id)
		),
		'actuator_state',
	),
)); ?>
