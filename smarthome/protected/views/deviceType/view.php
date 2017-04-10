<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

$this->breadcrumbs = array(
    'Device Types' => array('index'),
    $model->id,
);

?>
<ul class="menu_right_float">
    <li class="menu item">
	<a class="menu item link" href="<?= $this->createAbsoluteUrl('devicetype/index'); ?>">
	    <i class="fa fa-file-text-o" aria-hidden="true"></i> List
	</a>
    </li>
    <li class="menu item">
	<a class="menu item link" href="<?= $this->createAbsoluteUrl('devicetype/create'); ?>">
	    <i class="fa fa-file-o" aria-hidden="true"></i> New
	</a>
    </li>
    <li class="menu item">
	<a class="menu item link" href="<?= $this->createAbsoluteUrl('devicetype/update/'.$model->id); ?>">
	    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
	</a>
    </li>
    <li class="menu item">
	<a href="javascript:void(0);" class="del-item" data-id="<?= $model->id; ?>" data-type="deviceType" class="menu item link">
	    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
	</a>
    </li>
</ul>
<h1>Device Type "<?= $model->type; ?>"</h1>

<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
	'id',
	'type',
	'description',
	'treshold',
	'theshold_state',
    ],
]);
?>
