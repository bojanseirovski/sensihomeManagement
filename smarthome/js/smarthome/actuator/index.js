$(document).ready(function() {
    var action_url = $('#load_actuator_data_url').text();
    var single_actuator_url = $('#single_actuator_url').text();
    var base_url_path = $('#base_url_path').text();
    loadActuatorCharts(base_url_path,action_url,single_actuator_url);
});
