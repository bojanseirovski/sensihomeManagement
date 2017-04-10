
function checkNewDevice(url, resultContainerId, responseContainerId) {
    $.ajax({
	type: "GET",
	url: url,
	dataType: 'json',
	error: function (returnval) {
	    alert("Error! Please try again later.");
	},
	success: function (data, status, xh) {
	    if (data && (data.status == "OK") && (data.device_registered = true) && data.device_name && data.device_type) {
		var theResult = data.device_id + ':  Name:' + data.device_name + '; Type:' + data.device_type + " - ";
		var theResultContainer = $('<div id="device_' + data.device_id + '">');
		theResultContainer.html(theResult);
		var devTypeurl = 'sensor';
		if (data.device_type == 'A') {
		    devTypeurl = 'actuator';
		}
		theResultContainer.append($('<a>').attr('target', '_blank').attr('href', baseUrl + '/' + devTypeurl + '/view/' + data.device_id).html('Manage ' + devTypeurl));

		if (data.device_type == 'H') {
		    devTypeurl = 'actuator';
		    theResultContainer.append($('<span>').html('  |   '));
		    theResultContainer.append($('<a>').attr('target', '_blank').attr('href', baseUrl + '/' + devTypeurl + '/view/' + data.device_id).html('Manage ' + devTypeurl));
		}
		$(resultContainerId).append(theResultContainer);

		$(responseContainerId).html('true');
	    }
	}
    });
}

function ackNewDevice(url, responseContainerId) {
    $.ajax({
	type: "GET",
	url: url,
	dataType: 'json',
	error: function (returnval) {
	    alert("Error! Please try again later.");
	},
	success: function (data, status, xh) {
	    if (data && (data.status = 'OK')) {
		$(responseContainerId).html('true');
	    }
	}
    });
}

function loadActuatorCharts(base_url_path, action_url, single_actuator_url) {
    var theSeries = [];
    var theDataSensors = [];
    $.ajax({
	type: "GET",
	url: action_url,
	dataType: 'json',
	error: function (returnval) {
	    alert("Error! Please try again later.");
	},
	success: function (data, status, xh) {
	    if (data) {
		theSeries = [];
		theDataSensors = [];
		var measured = data.data;
		var cats = data.cats;
		var sensorTypesCount = data.sensor_type_count;
		var ticks = [];
		var actuatorIds = [];
		$.each(cats, function (i, v) {
		    theSeries.push({label: v[2] + " (" + v[1] + ") - actuator"});
		    actuatorIds.push(v[1]);
		    theDataSensors[v[1]] = Array();
		});

		var oneFourth = Math.round(measured.length / 4);
		var nextFourth = 1;
		$.each(measured, function (i, v) {
		    var fraction = Math.round(i / oneFourth);

		    var yeardate = v.date_created.split(' ');
		    var theDate = yeardate[0].split('-');
		    if (fraction >= nextFourth) {
			var monthNum = parseInt(theDate[1]) - 1;
			ticks.push(monthNamesShort[monthNum] + "-" + theDate[2]);
			nextFourth++;
		    }
		    else {
			ticks.push("");
		    }
		});

		$.each(theDataSensors, function (iter, val) {
		    if ((val !== 'undefined') && (typeof val !== undefined)) {
			$.each(measured, function (i, v) {
			    if (iter == v.sensor_id) {
				theDataSensors[v.sensor_id].push(parseFloat(v.value));
			    }
			});
		    }
		});
		if(actuatorIds.length>0){
		    $("#noData").remove();
		}
		var resultCount = 0;
		$.each(actuatorIds, function (acIdKey, acIdVal) {
		    var colorNum = Math.floor(Math.random() * 901);
		    var c_color = '#007' + colorNum;
		    var divId = 'chartact' + acIdVal;
		    if ($('#' + divId)[0]) {
			divId = 'chartact' + acIdVal + '-' + resultCount;
		    }
		    $('#content').append($('<div>').attr('id', divId).attr('style', 'width:400px; height:200px;'))
		    $('#' + divId).attr('data-id', acIdVal);

		    $('#' + divId).on('click', function (e) {
			document.location = single_actuator_url + '/' + $(this).data('id');
		    });
		    try {
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
		    }
		    catch (e) {
			$('#' + divId).html('<img src="' + base_url_path + '/images/switch-off.png" class="act_off" width="100px">');
			$('#' + divId).append('<p>No data for ' + theSeries[0].label + '</p>');

		    }
		    resultCount++;

		});
	    }
	    else {
		alert("Error! Please try again later.");
	    }
	}
    });
}

function loadSensorCharts(action_url, single_sensor_url) {
    var theSeries = [];
    var theDataSensors = [];
    $.ajax({
	type: "GET",
	url: action_url,
	dataType: 'json',
	error: function (returnval) {
	    alert("Error! Please try again later.");
	},
	success: function (data, status, xh) {
	    theSeries = [];
	    theDataSensors = [];
	    if (data) {
		var measured = data.data;
		var cats = data.cats;
		var sensorTypesCount = data.sensor_type_count;
		var ticks = [];
		var sensorIds = [];

		$.each(cats, function (i, v) {
		    theSeries.push({label: v[3] + " (" + v[2] + ") - sensor"});
		    theDataSensors[v[1]] = Array();
		    sensorIds.push(v[1]);
		});

		var oneFourth = Math.round(measured.length / 4);
		var nextFourth = 1;
		$.each(measured, function (i, v) {
		    var fraction = Math.round(i / oneFourth);
		    var yeardate = v.date_measured.split(' ');
		    var theDate = yeardate[0].split('-');

		    if (fraction >= nextFourth) {
			var monthNum = parseInt(theDate[1]) - 1;
			ticks.push(monthNamesShort[monthNum] + "-" + theDate[2]);
			nextFourth++;
		    }
		    else {
			ticks.push("");
		    }
		});

		$.each(theDataSensors, function (iter, val) {
		    if (val !== 'undefined') {
			$.each(measured, function (i, v) {
			    if (iter == v.sensor_id) {
				theDataSensors[v.sensor_id].push(parseFloat(v.value));
			    }
			});
		    }
		});
		if(actuatorIds.length>0){
		    $("#noData").remove();
		}

		var resultCount = 0;
		$.each(sensorIds, function (senIdKey, senIdVal) {
		    var c_color = '#007' + Math.abs(resultCount - 1) + resultCount + 'A';
		    var divId = 'chart' + senIdVal;
		    $('#content').append($('<div>').attr('id', divId).attr('style', 'width:400px; height:200px;'))
		    $('#' + divId).attr('data-id', senIdVal);

		    $('#' + divId).on('click', function (e) {
			document.location = single_sensor_url + '/' + $(this).data('id');
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
}
