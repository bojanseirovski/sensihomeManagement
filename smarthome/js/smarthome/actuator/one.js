$(document).ready(function () {
				var action_url = $('#load_actuator_data_url').text();
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
																				theSeries.push({label: v[2] + " (" + v[1] + ") - actuator"});
																				$('#this_page_title').html(v[2] + " (" + v[1] + ") - actuator");
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
																								ticks.push(formatedDate[0] + '-' + monthNamesShort[monthNum] + '-' + formatedDate[2]);
																								nextFourth++;
																				} else {
																								ticks.push('');
																				}
																				ticksLab.push(v.date_measured);
																});

																$.each(measured, function (i, v) {
																				theData.push(parseFloat(v.value));
																});

																var c_color = '#0073A4';
																var divId = 'chartact';
																if (theDataSensors != 'undefined' && theDataSensors != undefined) {
																				$('#thechart').append($('<div>').attr('id', divId + 'info').attr('style', 'width:600px; height:30px;'))
																				$('#thechart').append($('<div>').attr('id', divId).attr('style', 'width:600px; height:400px;'))

																				var plot1 = $.jqplot(divId, [theData], {
																								title: $('#dev_name').text(),
																								seriesDefaults: {
																												renderer: $.jqplot.BarRenderer,
																												rendererOptions: {fillToZero: true},
																												pointLabels: {
																																show: false
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
																												}
																								},
																								cursor: {
																												show: false,
																								},
																								highlighter: {
																												tooltipContentEditor: function (str, seriesIndex, pointIndex) {
																																return ticksLab[pointIndex];
																												},
																												show: true,
																												showTooltip: true,
																												tooltipFade: true,
																												sizeAdjust: 1,
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

				$('#changeActState').click(function () {
								var aid = $(this).data('id');
								var lurl = $(this).data('lurl');
								var url = $(this).data('url');

								$.ajax({
												type: "GET",
												url: lurl,
												data:{id:aid,url:url},
												dataType: 'json',
												error: function (returnval) {
																alert("Error! Please try again later.");
												},
												success: function (data, status, xh) {
																if (data.status == "OK") {
																				window.location.reload();
																}
												}
								});
				});
});
