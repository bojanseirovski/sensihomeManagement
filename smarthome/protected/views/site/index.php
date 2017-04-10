<h2>Dashboard</h2>

<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/jquery.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/jquery.jqplot.min.js"></script>
<script type="text/html" id="load_data_url"><?=$this->createAbsoluteUrl('sensor/sensors'); ?>?ajax=1</script>
<script type="text/html" id="load_actuator_data_url"><?=$this->createAbsoluteUrl('actuator/actuators'); ?>?ajax=1</script>
<script type="text/html" id="single_sensor_url"><?=$this->createAbsoluteUrl('sensor/one'); ?></script>
<script type="text/html" id="single_actuator_url"><?=$this->createAbsoluteUrl('actuator/one'); ?></script>



<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/smarthome/sensor/index.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/smarthome/actuator/index.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>

<div id="noData">
    <h3>Currently there are no registered devices!</h3>
    <div>
	You can <a href="<?=$this->createAbsoluteUrl('/sensor/create'); ?>">add a sensor</a>, <a href="<?=$this->createAbsoluteUrl('/actuator/create'); ?>">add an actuator</a> or wait for <?=Yii::app()->name?> to discover any active devices.
    </div>
</div>
