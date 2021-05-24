$(document).ready(function() {
    var port = $("#transmission-rpc-port-input");
    var username = $("#transmission-rpc-username-input");
    var password = $("#transmission-rpc-password-input");
    var savesettings = function(){
        url = OC.generateUrl('/apps/transmission/save');
        var formData = {
            'port':     port.val(),
            'username': username.val(),
            'password': password.val(),
        };
        $.ajax({
            url: url,
            data: formData,
            dataType: "json",
            type: 'post',
        });
    };
    port.on('change', savesettings);
    username.on('change', savesettings);
    password.on('change', savesettings);
});
