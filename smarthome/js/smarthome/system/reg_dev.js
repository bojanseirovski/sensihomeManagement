$(document).ready(function() {
    
    var checkUrl = $('#check_new_device_url').text();
    var ackUrl = $('#ack_new_device_url').text();
    
    var theCheckInterval = setInterval(function() {
        if ($('#check_new_device_response').text() == 'false') {
            if ($('#check_new_device_ajax_done').text() == 'false') {
                checkNewDevice(checkUrl, '#new_device_info', '#check_new_device_response');
            }
        }
        else{
            ackNewDevice(ackUrl,"#ack_new_device_ajax_done");
            $('#check_new_device_response').html('false');
        }
    }, 2000);
    
});