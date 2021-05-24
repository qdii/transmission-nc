$(document).ready(function() {
    var port = $("#transmission-rpc-port-input");
    port.on('change', function savesettings(){
        url = OC.generateUrl('/apps/transmission/save');
        var formData = {
            'port': port.val(),
        };
        $.ajax({
            url: url,
            data: formData,
            dataType: "json",
            type: 'post',
        });
    });
});
