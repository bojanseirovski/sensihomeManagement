
function isInt(value) {
    return !isNaN(value) && parseInt(Number(value)) == value && !isNaN(parseInt(value, 10));
}

function deleteItem(id, type) {
    var r = confirm("Are you sure you want to delete this " + type + " ?");
    if (r == true) {
	window.location = baseUrl + '/' + type + '/delete/' + id;
    }
}

function search(urlId, queryId) {
    if ($('#'+urlId)[0]) {
	var url = $('#'+urlId).text();
	var query = $('#'+queryId).val();
	window.location = url + query;
    }
}
	
function tooltipContentEditor(str, seriesIndex, pointIndex, plot) {
    // display series_label, x-axis_tick, y-axis value
    return plot.series[seriesIndex]["label"] + ", " + plot.data[seriesIndex][pointIndex];
}
