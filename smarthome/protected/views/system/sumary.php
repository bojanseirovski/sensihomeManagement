<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/smarthome/system/sumary.css">
    
<div class="container">
    <div id="sumary">
        <h2>Total devices : <?= count($sensorCount) + count($actuatorCount) ?></h2>
    </div>
    <div id="server_details">
        <h3>IP address : <?= $serverIp ?></h3>
    </div>
    <div id="sensor_list">
        <h3>Sensors</h3>
        <h4><a href="<?= $this->createUrl('/sensor/list'); ?>"><?= count($sensorCount) ?></a></h4>
    </div>
    <div id="actuator_list">
        <h3>Actuators</h3>
        <h4><a href="<?=$this->createUrl("/actuator/list"); ?>"><?= count($actuatorCount) ?></a></h4>
    </div>
</div>

