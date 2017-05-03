$(document).ready(function () {
    var action_url = $('#load_data_url').text();
    var theSeries = [];
    var theDataSensors = [];
    var theData = [];
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
	    theData = [];
	    var ticks = [];
	    if (data) {
		var measured = data.data;
		var cats = data.cats;

		$.each(cats, function (i, v) {
		    theSeries.push({label: v[3] + " (" + v[2] + ") - sensor"});
		    $('#this_page_title').html(v[3] + " - sensor");
		});

		var serial = 0;
		var devIp = '';
		var oneEight = Math.round(measured.length / 8);
		var nextFourth = 1;
		$.each(measured, function (i, v) {
		    var fraction = Math.round(i / oneEight);
		    serial = v.serial;
		    devIp = v.com_id;
		    var yeardate = v.date_measured.split(' ');
		    if (fraction >= nextFourth) {
			var formatedDate = yeardate[0].split('-');
			var monthNum = parseInt(formatedDate[1]) - 1;
			ticks.push(formatedDate[0] + ' <b>' + monthNamesShort[monthNum] + '</b> ' + formatedDate[2] + "\n" + yeardate[1]);
			nextFourth++;
		    } else {
			ticks.push('');
		    }

		});
		$.each(measured, function (i, v) {
		    theData.push(parseFloat(v.value));
		});

		var c_color = '#00731A';
		var divId = 'chart';
		if (theDataSensors != 'undefined' && theDataSensors != undefined) {
		    $('#content').append($('<div>').attr('id', divId + 'info').attr('style', 'width:600px; height:30px;'))
		    $('#content').append($('<div>').attr('id', divId).attr('style', 'width:600px; height:400px;'))
		    var plot1 = $.jqplot(divId, [theData], {
			title: $('#dev_name').text(),
			seriesDefaults: {
//			    renderer: $.jqplot.BarRenderer,
//			    rendererOptions: {fillToZero: true},
			    pointLabels: {
				show: true,
				edgeTolerance: 0
			    }
			},
			seriesColors: [c_color],
			series: theSeries,
			legend: {
			    show: false,
			},
			axes: {
			    xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer,
				ticks: ticks,
				tickOptions: {
				    formatString: '%b&nbsp;%#d'
				}
			    },
			    yaxis: {
				pad: 1.05,
				tickOptions: {formatString: '%.2f'}
			    }
			},
			cursor: {
			    show: true,
			    tooltipLocation: 'ne'
			},
			highlighter: {
			    show: true,
			    showTooltip : true,
			    tooltipLocation :'n',
			    sizeAdjust: 7.5
			}
		    });

		    if (serial) {
			$('#sub-menu ul').append('<li class="submenu"><a href="http://' + devIp + '/id/' + serial + '/  ">Go to device</a></li>');
		    }

		}
	    } else {
		alert("Error! Please try again later.");
	    }
	}
    });
});
