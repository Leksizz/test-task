// Скрипт для отправки форм на сервер

$(document).ready(function () {
    $('form').submit(function (event) {
        let json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                json = jQuery.parseJSON(result);
                if (json.status === 'error') {
                    document.getElementById('error').innerText = json.message
                }
                if (json.href) {
                    window.location.href = '/' + json.href;
                }
            },
        });
    });
});