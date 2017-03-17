<ul class="menu_right_float">
				<li class="menu item">
								<a class="menu item link" href="<?=	$this->createAbsoluteUrl('sensor/list');	?>">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage
								</a>
				</li>
				<li class="menu item">
								<a class="menu item link" href="<?=	$this->createAbsoluteUrl('sensor/create');	?>">
												<i class="fa fa-file-o" aria-hidden="true"></i> New
								</a>
				</li>
</ul>

<h2>Sensor Dashboard</h2>
<script type="text/html" id="load_data_url"><?=	$this->createAbsoluteUrl('sensor/sensors');	?>?ajax=1</script>
<script type="text/html" id="single_sensor_url"><?=	$this->createAbsoluteUrl('sensor/one');	?></script>



<script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/smarthome/sensor/index.js"></script>
<script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="<?=	Yii::app()->request->baseUrl;	?>/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>

