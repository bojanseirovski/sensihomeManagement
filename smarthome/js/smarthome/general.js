var baseUrl = '';
$(document).ready(function() {
    baseUrl = $('#base_url').text();

    $('.submenu-parent ul').hide();

    $('.submenu-parent').mouseenter(function() {
        $(this).find('ul').show();
    });
    $('.submenu-parent').mouseleave(function() {
        $(this).find('ul').hide();
    });
});

function checkNewDevice(url,resultContainerId , responseContainerId) {
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        error: function(returnval) {
            alert("Error! Please try again later.");
        },
        success: function(data, status, xh) {
            if(data && (data.status=="OK") &&  (data.device_registered=true) && data.device_name && data.device_type){
                var theResult = data.device_id+':  Name:'+data.device_name +'; Type:'+data.device_type +" - ";
                var theResultContainer = $('<div id="device_'+data.device_id+'">');
                theResultContainer.html(theResult);
                var devTypeurl = 'sensor';
                if(data.device_type=='A'){
                    devTypeurl = 'actuator';
                }
                theResultContainer.append($('<a>').attr('target','_blank').attr('href',baseUrl+'/'+devTypeurl+'/view/'+data.device_id).html('Manage '+devTypeurl));
                
                if(data.device_type=='H'){
                    devTypeurl = 'actuator';
                    theResultContainer.append($('<span>').html('  |   '));
                    theResultContainer.append($('<a>').attr('target','_blank').attr('href',baseUrl+'/'+devTypeurl+'/view/'+data.device_id).html('Manage '+devTypeurl));
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
        error: function(returnval) {
            alert("Error! Please try again later.");
        },
        success: function(data, status, xh) {
            if(data && (data.status='OK')){
                $(responseContainerId).html('true');
            }
        }
    });
}