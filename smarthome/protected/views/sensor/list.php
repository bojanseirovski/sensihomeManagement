<?php
$this->breadcrumbs = array( 'Sensors');
$baseUrl = Yii::app()->request->baseUrl;
?>
<script type="text/html" id="search_url"><?= $this->createAbsoluteUrl('/sensor/list'); ?>?query=</script>
<ul class="menu_right_float">
    <li class="menu item">
	<a class="menu item link" href="<?= $this->createAbsoluteUrl('sensor/create'); ?>">
	    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> New
	</a>
    </li>
</ul>
<div>
    <br/>
</div>
<script type="text/javascript" src="<?= $baseUrl; ?>/js/smarthome/sensor/list.js"></script>
<h1>Sensors</h1>
<div class="row">
    <div class="col-lg col-lg-3">
	<input type="text" class="form-control" name="query" id="query" value="<?=$qry;?>" placeholder="Search by name, IP, serial">
    </div>
    <div class="col-lg col-lg-2">
	<a href="javascript:void(0);" class="btn btn-success searchdev"><i class="fa fa-search" aria-hidden="true"></i> Search</a>
    </div>
    <div class="col-lg col-lg-1">
	<a href="<?= $this->createAbsoluteUrl('/sensor/list'); ?>" class="btn btn-info"> Reset</a>
    </div>
</div>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
