$(document).ready(function () {
    var action_url = $('#load_data_url').text();
    var single_sensor_url = $('#single_sensor_url').text();
    loadSensorCharts(action_url, single_sensor_url)
});
