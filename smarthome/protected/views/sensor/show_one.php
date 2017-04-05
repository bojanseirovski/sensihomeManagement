<h2 id="this_page_title"></h2>
<div class="menu-container">
    <ul class="menu_right_float">
								<li class="menu item">
												<a class="menu item link" href="<?=	$this->createAbsoluteUrl('/sensor/update/'	.	$id);	?>">
																<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
												</a>
								</li>
								<li class="menu item">
												<a class="menu item link" href="<?=	$this->createAbsoluteUrl('/sensor/list');	?>">
																<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage all
												</a>
								</li>
								<li class="menu item">
												<a class="menu item link" href="<?=	$this->createAbsoluteUrl('sensor/create');	?>">
																<i class="fa fa-file-o" aria-hidden="true"></i> New
												</a>
								</li>
								<li class="menu item">
												<a href="http://<?=	$data->com_id;	?>/id/<?=	$data->serial;	?>" target="_blank">
																<i class="fa fa-hand-o-right" aria-hidden="true"></i> Go to device
												</a>
								</li>
    </ul>
    <div class="device_info">
								<div><strong>Name : </strong><?=	CHtml::encode($data->name);	?></div>
								<div><strong>IP address : </strong><?=	CHtml::encode($data->com_id);	?></div>
								<div><strong>Added on : </strong><?=	date('d M Y',	strtotime($data->date_created));	?></div>
								<div><strong>Type: </strong><?=	CHtml::encode(SensorType::model()->findByPk($data->type)->type_name);	?></div>
								<div><strong>Unit: </strong><?=	CHtml::encode($data->unit);	?></div>
								<div><strong>History: </strong><a class="menu item link" href="<?=	$this->createAbsoluteUrl('/search/index?s='.$data->id);	?>"><?=	CHtml::encode($data->name);	?></a></div>
    </div>
    <script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/jquery.min.js"></script>
    <script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/jquery.jqplot.min.js"></script>
    <script type="text/html" id="load_data_url"><?=	$this->createAbsoluteUrl('sensor/sensor');	?>?id=<?=	$id;	?>&ajax=1</script>
    <script type="text/html" id="dev_name"><?=	CHtml::encode($data->name);	?></script>



    <script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/smarthome/sensor/one.js"></script>
    <script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.barRenderer.min.js"></script>
    <script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
    <script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>

