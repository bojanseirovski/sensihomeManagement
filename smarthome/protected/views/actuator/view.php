<?php
/* @var $this ActuatorController */
/* @var $model Actuator */

$this->breadcrumbs = array(
    'Actuators' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => '<i class="fa fa-plus-square-o" aria-hidden="true"></i> New', 'url' => array('create')),
    array('label' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', 'url' => array('update', 'id' => $model->aid)),
    array('label' => '<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->aid), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => '<i class="fa fa-list" aria-hidden="true"></i>Manage', 'url' => array('list')),
);
?>

<h1>Actuator "<?php echo $model->name; ?>"</h1>

<?php
$typeAcc = Actuator::model()->getActuatorNameIdType($model->aid);
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
	'aid',
	'type' => array(
	    'label' => 'Type',
	    'value' => isset($typeAcc['type_name']) ? $typeAcc['type_name'] : ''
	),
	'state',
	'name',
	'value_fields',
	'com_id',
	'system_id',
	'date_created',
    ),
));
?>
