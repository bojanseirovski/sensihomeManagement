<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<link  rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/css/smarthome/alert/index.css" />
<?php
/* @var $this UserController */
/* @var $model User */
?>
<h1>Details for "<?php echo $model->name; ?>"</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
	'name',
	'username',
	array(
	    'name' => 'notify',
	    'label' => 'Receive alert notifications',
	    'type' => 'raw',
	    'value' => isset($model->notify)?'Yes':'No'
	),
    ),
));
?>
<div>
    <a class="menu item link" href="<?= $this->createAbsoluteUrl('/user/update/' . $model->id); ?>">
	<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update account
    </a>
</div>
<hr/>

<h2>System details</h2>
<div id="system_status">
    <a href="<?= $this->createUrl('system/usersumary'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Status</a>
</div>
<div id="system_details">
    <a href="<?= $this->createUrl('system/' . Yii::app()->session['system_id']); ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Details</a>
</div>
<div id="system_details">
    <a href="<?= $this->createUrl('deviceType/index'); ?>"><i class="fa fa-cogs" aria-hidden="true"></i> Device Types</a>
</div>
<div id="system_details">
    <a href="<?= $this->createUrl('sensor/create'); ?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Add Sensor</a>
</div>
<div id="system_details">
    <a href="<?= $this->createUrl('actuator/create'); ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Add Actuator</a>
</div>

<hr/>
