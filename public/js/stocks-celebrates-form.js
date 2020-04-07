// $('#senderror').hide();
// $('#sendmessage').hide();
$(document).ready(function () {
    console.log('stocks-celebrates-form.js');
    $('#celebrates button').on('click', function (e) {
        console.log(e);
        e.preventDefault();
        // console.log($('#twodates').serialize());
        // return;
        $.ajax({
            type: 'GET',
            url: '/sendStocksCelebrates',
            data: $('#celebrates').serialize(),
            success: function (data) {
                if (data.result) {
                    // $('#senderror').hide();
                    // $('#sendmessage').show();
                    console.log(data);
                } else {
                    // $('#senderror').show();
                    // $('#sendmessage').hide();
                    console.log(data);
                }
            },
            error: function () {
                // $('#senderror').show();
                // $('#sendmessage').hide();
            }
        });
    });
});