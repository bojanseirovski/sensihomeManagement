<?php
$devState = $lastVal == "0" ? 'OFF' : 'ON';
?>

<div class="menu-container">
    <ul class="menu_right_float">
        <li class="menu item">
            <a class="menu item link" href="<?= $this->createAbsoluteUrl('/actuator/update/' . $id); ?>">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
            </a>
        </li>
        <li class="menu item">
            <a class="menu item link" href="<?= $this->createAbsoluteUrl('/actuator/list'); ?>">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage all
            </a>
        </li>
        <li class="menu item">
            <a class="menu item link" href="<?= $this->createAbsoluteUrl('actuator/create'); ?>">
                <i class="fa fa-file-o" aria-hidden="true"></i> New
            </a>
        </li>
        <li class="menu item">
            <a href="http://<?= $data->com_id; ?>/id/<?= $data->serial; ?>" target="_blank">
                <i class="fa fa-hand-o-right" aria-hidden="true"></i> Go to device
            </a>
        </li>
    </ul>
    <div>
        <br/>
    </div>
    <h2 id="this_page_title"></h2>
    <div id="thechart"></div>
    <div class="device_info">
        <div>
            <h4>
                Toggle state: 
                <a href="javascript:void(0);" 
                   data-url="http://<?= $data->com_id; ?>/id/<?= $data->serial; ?>/pin/<?= $devState; ?>/reqtype/json" 
                   data-lurl="<?= $this->createAbsoluteUrl('actuator/toggle'); ?>" 
                   id="changeActState" 
                   data-id="<?= $data->aid; ?>">
                       <?= $devState; ?>
                </a>
            </h4>
        </div>
        <div><strong>Name : </strong><?= CHtml::encode($data->name); ?></div>
        <div><strong>IP address : </strong><?= CHtml::encode($data->com_id); ?></div>
        <div><strong>Added on : </strong><?= date('d M Y', strtotime($data->date_created)); ?></div>
        <div><strong>Type: </strong><?= CHtml::encode(ActuatorType::model()->findByPk($data->type)->type_name) ?></div>
        <div><strong>Default state: </strong><?= $data->state; ?></div>
        <div><strong>History: </strong><a class="menu item link" href="<?= $this->createAbsoluteUrl('/search/index?a=' . $data->aid); ?>"><?= CHtml::encode($data->name); ?></a></div>
    </div>
</div>
<script type="text/html" id="load_actuator_data_url"><?= $this->createAbsoluteUrl('actuator/actuator'); ?>?id=<?= CHtml::encode($id); ?>&ajax=1</script>
<script type="text/html" id="dev_name"><?= CHtml::encode($data->name); ?></script>



<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/smarthome/actuator/one.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>

