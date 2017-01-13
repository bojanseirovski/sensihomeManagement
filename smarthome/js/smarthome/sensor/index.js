$(document).ready(function() {
    var action_url = $('#load_data_url').text();
    var single_sensor_url = $('#single_sensor_url').text();
    var theSeries = [];
    var theDataSensors = [];
    $.ajax({
        type: "GET",
        url: action_url,
        dataType: 'json',
        error: function(returnval) {
            alert("Error! Please try again later.");
        },
        success: function(data, status, xh) {
            theSeries = [];
            theDataSensors = [];
            if (data) {
                var measured = data.data;
                var cats = data.cats;
                var sensorTypesCount = data.sensor_type_count;
                var ticks = [];
                var sensorIds = [];

                $.each(cats, function(i, v) {
                    theSeries.push({label: v[3]+" ("+v[2]+") - sensor"});
                    theDataSensors[v[1]] = Array();
                    sensorIds.push(v[1]);
                });

                $.each(measured, function(i, v) {
                    var yeardate = v.date_measured.split(' ');
                    var theDate = yeardate[0].split('-');
                    ticks.push(theDate[1] + "-" + theDate[2]);
                });

                $.each(theDataSensors, function(iter, val) {
                    if (val !== 'undefined') {
                        $.each(measured, function(i, v) {
                            if (iter == v.sensor_id) {
                                theDataSensors[v.sensor_id].push(parseFloat(v.value));
                            }
                        });
                    }
                });
                
                var resultCount = 0;
                $.each(sensorIds,function(senIdKey, senIdVal){
                        var c_color = '#007' + Math.abs(resultCount - 1) + resultCount + 'A';
                        var divId = 'chart' + senIdVal;
                        $('#content').append($('<div>').attr('id', divId).attr('style', 'width:400px; height:200px;'))
                        $('#'+divId).attr('data-id',senIdVal);

                        $('#'+divId).on('click', function(e) {
                                document.location=single_sensor_url+'/'+$(this).data('id');
                        });
                        
                        var plot1 = $.jqplot(divId, [theDataSensors[senIdVal]], {
                            seriesDefaults: {
                                renderer: $.jqplot.BarRenderer,
                                rendererOptions: {fillToZero: true}
                            },
                            seriesColors: [c_color],
                            series: [theSeries[resultCount]],
                            legend: {
                                show: true,
                                placement: 'outsideGrid'
                            },
                            axes: {
                                xaxis: {
                                    renderer: $.jqplot.CategoryAxisRenderer,
                                    ticks: ticks
                                },
                                yaxis: {
                                    pad: 1.05,
                                    tickOptions: {formatString: '%.2f'}
                                }
                            }
                        });
                        resultCount++;
                });
            }
            else {
                alert("Error! Please try again later.");
            }
        }
    });
});