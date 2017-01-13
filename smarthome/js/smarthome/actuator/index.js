$(document).ready(function() {
    var action_url = $('#load_actuator_data_url').text();
    var single_actuator_url = $('#single_actuator_url').text();
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
            if (data) {
                theSeries = [];
                theDataSensors = [];
                var measured = data.data;
                var cats = data.cats;
                var sensorTypesCount = data.sensor_type_count;
                var ticks = [];
                var actuatorIds = [];
                $.each(cats, function(i, v) {
                    theSeries.push({label: v[2]+" ("+v[1]+") - actuator"});
                    actuatorIds.push(v[1]);
                    theDataSensors[v[1]] = Array();
                });

                $.each(measured, function(i, v) {
                    var yeardate = v.date_created.split(' ');
                    var theDate = yeardate[0].split('-');
                    ticks.push(theDate[1] + "-" + theDate[2]);
                });

                $.each(theDataSensors, function(iter, val) {
                    if ((val !== 'undefined')  && (typeof val !== undefined)) {
                        $.each(measured, function(i, v) {
                            if (iter == v.sensor_id) {
                                theDataSensors[v.sensor_id].push(parseFloat(v.value));
                            }
                        });
                    }
                });
                
                var resultCount = 0;
                $.each(actuatorIds,function(acIdKey, acIdVal){
                    var colorNum = Math.floor(Math.random()*901 );
                    var c_color = '#007' + colorNum;
                    var divId = 'chartact' + acIdVal;
                    $('#content').append($('<div>').attr('id', divId).attr('style', 'width:400px; height:200px;'))
                    $('#' + divId).attr('data-id', acIdVal);

                    $('#' + divId).on('click', function(e) {
                        document.location = single_actuator_url + '/' + $(this).data('id');
                    });
                    var plot1 = $.jqplot(divId, [theDataSensors[acIdVal]], {
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
                                pad: 1,
                                tickOptions: {formatString: '%d'}
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