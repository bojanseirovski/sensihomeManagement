$(document).ready(function() {
    var action_url = $('#load_data_url').text();
    var theSeries = [];
    var theDataSensors = [];
    var theData = [];
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
            theData = [];
            var ticks = [];
            if (data) {
                var measured = data.data;
                var cats = data.cats;

                $.each(cats, function(i, v) {
                    theSeries.push({label: v[3]+" ("+v[2]+") - sensor"});
                    $('#this_page_title').html(v[3]+" - sensor");
                });

                var serial = 0;
                var devIp = '';
                $.each(measured, function(i, v) {
                    serial = v.serial;
                    devIp = v.com_id;
                    var yeardate = v.date_measured.split(' ');
                    ticks.push(yeardate[0]);
                });
                $.each(measured, function(i, v) {
                        theData.push(parseFloat(v.value));
                });
                
                var c_color = '#00731A';
                var divId = 'chart';
                if (theDataSensors != 'undefined' && theDataSensors != undefined) {
                    $('#content').append($('<div>').attr('id', divId).attr('style', 'width:800px; height:400px;'))

                    var plot1 = $.jqplot(divId, [theData], {
                        seriesDefaults: {
                            renderer: $.jqplot.BarRenderer,
                            rendererOptions: {fillToZero: true}
                        },
                        seriesColors: [c_color],
                        series: theSeries,
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
                    if(serial){
                        $('#sub-menu ul').append('<li class="submenu"><a href="http://'+devIp+'/id/'+serial+'/  ">Go to device</a></li>');
                    }
                    
                }
            }
            else {
                alert("Error! Please try again later.");
            }
        }
    });
});