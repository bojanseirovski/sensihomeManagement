<?php
$this->breadcrumbs = array('Rules' => array('index'), $model->id);
?>
<ul class="menu_right_float">
    <li class="menu item">
	<a class="menu item link" href="<?= $this->createAbsoluteUrl('/alert/update/' . $model->id); ?>">
	    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
	</a>
    </li>
    <li class="menu item">
	<a class="menu item link" href="<?= $this->createAbsoluteUrl('/alert/create'); ?>">
	    <i class="fa fa-file-o" aria-hidden="true"></i> New
	</a>
    </li>
    <li class="menu item">
	<a class="menu item link" href="<?= $this->createAbsoluteUrl('/alert/list'); ?>">
	    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage all
	</a>
    </li>
    <li class="menu item">
	<a href="javascript:void(0);" class="del-item" data-id="<?= $model->id; ?>" data-type="alert">
	    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
	</a>
    </li>
</ul>
    <div>
	<br/>
    </div>
<h1>Rule :<?php echo $model->action; ?></h1>
<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
	'action',
	'scheduled_on'=>[
	    'label' => 'Scheduled',
	    'type' => 'raw',
	    'value' => date('M d Y', strtotime($model->scheduled_on)),
	],
	'triggered_by' => [
	    'label' => 'Triggered by',
	    'type' => 'raw',
	    "value" => CHtml::link($this->getSensorNameAndId($model->triggered_by)['name'], ['/sensor/one', 'id' => $model->triggered_by])
	],
	'trigger_value',
	'enabled' => [
	    "label" => "Enabled",
	    'type' => 'raw',
	    "value" => ($model->enabled == 1) ? 'yes' : 'no'
	],
	'date_created'=>[
	    'label' => 'Created',
	    'type' => 'raw',
	    'value' => date('M d Y', strtotime($model->date_created)),
	],
	'actuator_id' => [
	    "label" => "Actuator",
	    'type' => 'raw',
	    "value" => CHtml::link($this->getActuatorNameAndId($model->actuator_id)['name'], ['/actuator/one', 'id' => $model->actuator_id])
	],
	'actuator_state',
    ],
	]
);
?>
