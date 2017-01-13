<script type="text/html" id="check_new_device_url"><?=$this->createAbsoluteUrl('system/checknewdevice'); ?></script>
<script type="text/html" id="ack_new_device_url"><?=$this->createAbsoluteUrl('system/acknewdevice'); ?></script>

<script type="text/html" id="check_new_device_ajax_done">false</script>
<script type="text/html" id="ack_new_device_ajax_done">false</script>
<script type="text/html" id="check_new_device_response">false</script>
<script type="text/html" id="ack_new_device_response">false</script>

<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/smarthome/system/reg_dev.js"></script>

<div id="loder_contain">
    <img src="<?=Yii::app()->baseUrl;?>/images/loader.gif" height="80px;">
</div>
<div id="status">
    <div id="lookup_status">
        Waiting for new devices to register to the system...
    </div>
    <div id="lookup_status">
        Current IP address : <?= Util::getRealIpAddr();?>
    </div>
</div>
<hr/>

<div id="new_device_info">

</div>