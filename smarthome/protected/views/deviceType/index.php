<?php
/* @var $this DeviceTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Device Types',
);

?>
<ul class="menu_right_float">
    <li class="menu item">
	<a class="menu item link" href="<?= $this->createAbsoluteUrl('devicetype/create'); ?>">
	    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> New
	</a>
    </li>
</ul>
<h1>Device Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
