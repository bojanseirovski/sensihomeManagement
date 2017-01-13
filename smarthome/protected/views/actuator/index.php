<h2>Actuator Dashboard</h2>
<div id="sub-menu">
    <?php
    $this->widget('zii.widgets.CMenu', array(
								'encodeLabel' => false,
        'items' => array(
                    array(
                        'label' => 'Manage', 'url' => array('/actuator/list'),
                        'visible' => !Yii::app()->user->isGuest,
                        'linkOptions' => array('class' => 'sub-submenu-item'),
                        'itemOptions' => array('class' => 'submenu'),
                    ),
                    array(
                        'label' => 'New', 'url' => array('/actuator/create'),
                        'visible' => !Yii::app()->user->isGuest,
                        'linkOptions' => array('class' => 'sub-submenu-item'),
                        'itemOptions' => array('class' => 'submenu'),
                    ),
        ),
    ));
    ?>
</div>
<script type="text/html" id="load_actuator_data_url"><?= $this->createAbsoluteUrl('actuator/actuators'); ?>?ajax=1</script>
<script type="text/html" id="single_actuator_url"><?= $this->createAbsoluteUrl('actuator/one'); ?></script>



<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/smarthome/actuator/index.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>

