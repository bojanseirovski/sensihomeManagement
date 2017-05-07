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
												var ticksLab = [];
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
																				if ((fraction >= nextFourth) || (measured.length<4)) {
																								var formatedDate = yeardate[0].split('-');
																								var monthNum = parseInt(formatedDate[1]) - 1;
																								ticks.push(formatedDate[0] + ' <b>' + monthNamesShort[monthNum] + '</b> ' + formatedDate[2] + "\n" + yeardate[1]);
																								ticksLab.push(formatedDate[0] + ' <b>' + monthNamesShort[monthNum] + '</b> ' + formatedDate[2] + "\n" + yeardate[1]);
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
																												show: false
																								},
																								highlighter: {
																												tooltipContentEditor: function (str, seriesIndex, pointIndex, plot) {
																																return ticksLab[seriesIndex];
																												},
																												show: true,
																												showTooltip: true,
																												tooltipFade: true,
																												sizeAdjust: 7.5,
																												formatString: '%.2f',
																												tooltipLocation: 'ne',
																												tooltipAxes:'x',
																												useAxesFormatters: false,
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
