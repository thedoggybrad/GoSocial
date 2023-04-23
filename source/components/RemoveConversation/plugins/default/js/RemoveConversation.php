//<script>

$(document).ready(function() {

    if ($('.message-form-form').length) {
        if ($('input:hidden[name=to]').length === 0 || $('input:hidden[name=ossn_ts]').length === 0 || $('input:hidden[name=ossn_token]').length === 0) {
            console.log("Error on RemoveConversation. Check");
        } else {
            var $url = Ossn.site_url + 'removeconversation?id=' + $('input:hidden[name=to]').val() +
            '&ossn_token=' + $('input:hidden[name=ossn_token]').val() + "&ossn_ts=" + $('input:hidden[name=ossn_ts]').val();
        }
        $('<div class="delete-all"><a data-href="' + $url + '" data-id="' +
            $('input:hidden[name=to]').val() + '"><i class="fa fa-trash" data-toggle="tooltip" ' +
            'data-placement="top" title="<?php echo ossn_print("removeconversation:tip"); ?>">' +
            '</i></a></div>').appendTo('.messages-with .widget-heading');
    }
});

Ossn.RegisterStartupFunction(function () {
    $(document).ready(function () {
        $('body').on('click', '.delete-all > a', function (e) {
            var id = $(this).attr('data-id');
            Ossn.MessageBox('removeconversation?id=' + id);
        });
        Ossn.ajaxRequest({
            form: '#ossn-message-delete-all-form',
            url: Ossn.site_url + 'action/message/removeConversation',
            beforeSend: function () {
                $('#ossn-message-delete-form').html('<div class="ossn-loading"></div>');
            },
            callback: function (callback) {
                if (callback['status'] == true) {
                    Ossn.redirect('messages/all');
                }
            }
        });
    });
});