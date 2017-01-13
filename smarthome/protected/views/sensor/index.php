<h2>Sensor Dashboard</h2>
<div id="sub-menu">
    <?php
    $this->widget('zii.widgets.CMenu', array(
								'encodeLabel' => false,
        'items' => array(
                    array(
                        'label' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage', 
																								'url' => array('/sensor/list'),
                        'visible' => !Yii::app()->user->isGuest,
                        'linkOptions' => array('class' => 'sub-submenu-item'),
                        'itemOptions' => array('class' => 'submenu'),
                    ),
                    array(
                        'label' => '<i class="fa fa-file-o" aria-hidden="true"></i> New', 
																								'url' => array('/sensor/create'),
                        'visible' => !Yii::app()->user->isGuest,
                        'linkOptions' => array('class' => 'sub-submenu-item'),
                        'itemOptions' => array('class' => 'submenu'),
                    ),
        ),
    ));
    ?>
</div>
<script type="text/html" id="load_data_url"><?=$this->createAbsoluteUrl('sensor/sensors'); ?>?ajax=1</script>
<script type="text/html" id="single_sensor_url"><?=$this->createAbsoluteUrl('sensor/one'); ?></script>



<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/smarthome/sensor/index.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>

