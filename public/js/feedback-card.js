$('#senderror').hide();
$('#sendmessage').hide();
$(document).ready(function () {
    console.log('feedback-card.js');
    $('#feedbackform').on('submit', function (e) {
        e.preventDefault();
        console.log($('#feedbackform').serialize());
        $.ajax({
            type: 'GET',
            url: '/sendgiftcard',
            data: $('#feedbackform').serialize(),
            success: function (data) {
                if (data.result) {
                    $('#senderror').hide();
                    $('#sendmessage').show();
                    console.log(data);
                } else {
                    $('#senderror').show();
                    $('#sendmessage').hide();
                    console.log(data);
                }
            },
            error: function () {
                $('#senderror').show();
                $('#sendmessage').hide();
            }
        });
    });
});