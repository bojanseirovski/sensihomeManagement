<?php
$this->breadcrumbs	=	array('Measurements');
$baseUrl	=	Yii::app()->request->baseUrl;
?>
<script type="text/html" id="search_url"><?=	$this->createAbsoluteUrl('/search/index');	?>?query=</script>
<script type="text/javascript" src="<?=	$baseUrl;	?>/js/smarthome/search/list.js"></script>
<h1>Measurements</h1>
<div class="row">
    <div class="col-sm col-sm-3">
								<input type="text" class="form-control" name="query" id="query" value="<?=	$qry;	?>" placeholder="Search by name">
    </div>
    <div class="col-sm col-sm-3">
								<input type="text" class="form-control" name="date_from" id="date_from" value="<?=	$datef;	?>" placeholder="Start Date">
    </div>
    <div class="col-sm col-sm-3">
								<input type="text" class="form-control" name="date_to" id="date_to" value="<?=	$datet;	?>" placeholder="End Date">
    </div>
    <div class="col-sm col-sm-2">
								<a href="javascript:void(0);" class="btn btn-success searchdev"><i class="fa fa-search" aria-hidden="true"></i> Search</a>
    </div>
    <div class="col-sm col-sm-1">
								<a href="<?=	$this->createAbsoluteUrl('/search/index');	?>" class="btn btn-info"> Reset</a>
    </div>
</div>
<hr/>
<div class="row view">
    <div class="col-md col-md-3">
								<strong>Device</strong>
    </div>

    <div class="col-md col-md-2">
								<strong>Value</strong>
    </div>

    <div class="col-md col-md-2">
								<strong>Date</strong>
    </div>

    <div class="col-md col-md-2">
								<strong>Message</strong>
    </div>

    <div class="col-md col-md-2">
								<strong>Type</strong>
    </div>
</div>
<?php
$this->widget('zii.widgets.CListView',	array(
				'dataProvider'	=>	$dataProvider,
				'itemView'	=>	'_view',
));
?>
