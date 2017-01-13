<h2 id="this_page_title"></h2>
<div id="sub-menu">
    <?php
    $this->widget('zii.widgets.CMenu', array(
        'items' => array(
                    array(
                        'label' => 'Update', 'url' => array('/actuator/update/'.$id),
                        'visible' => !Yii::app()->user->isGuest,
                        'linkOptions' => array('class' => 'sub-submenu-item'),
                        'itemOptions' => array('class' => 'submenu'),
                    ),
                    array(
                        'label' => 'Manage all', 'url' => array('/actuator/list'),
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
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/jquery.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/jquery.jqplot.min.js"></script>
<script type="text/html" id="load_actuator_data_url"><?=$this->createAbsoluteUrl('actuator/actuator'); ?>?id=<?=$id;?>&ajax=1</script>



<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/smarthome/actuator/one.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>

