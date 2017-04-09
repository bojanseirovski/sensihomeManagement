var baseUrl = '';
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var monthNamesShort = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

$(document).ready(function () {
				baseUrl = $('#base_url').text();

				$('.submenu-parent ul').hide();

				$('.submenu-parent').mouseenter(function () {
								$(this).find('ul').show();
				});
				$('.submenu-parent').mouseleave(function () {
								$(this).find('ul').hide();
				});

				$('.del-item').click(function () {
								var thisType = $(this).data('type');
								var thisId = $(this).data('id');
								deleteItem(thisId, thisType);
				});

				$('.searchdev').click(function () {
								if($('#date_from')[0] && $('#date_to')[0]){
												var datef = $('#date_from').val();
												var datet = $('#date_to').val();
												searchDate('search_url', datef, datet);
								}
								else{
												search('search_url', 'query');
								}
				});

				$("#query").keyup(function (event) {
								if (event.keyCode == 13) {
												search('search_url', 'query');
								}
				});
});
