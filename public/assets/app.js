$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").click(function () {

        current_fs = $(this).parent();
        if (current_fs.data('ajax')) {
            ajax(current_fs);
            return;
        }

        show_next_fs(current_fs);
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#selector a").eq($("fieldset").index(current_fs)).removeClass("kb-link-active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function () {
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function () {
        return false;
    })

});
//fs = fieldset
function ajax(fs) {
    $.ajax({
        url: fs.data('url'),
        data: fs.find(':input').serialize(),
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('#token_ws').val(data.token);
            $('#url_ws').val(data.token);
            $('#price').html(data.sub.price);
            $('iframe').attr('height', '550px');
            show_next_fs(fs)
            post_to_iframe(data);
        }
    });
}

function post_to_iframe(data) {
    var html = '<form style="display:none;" target="webpay-iframe" method="post" action="' + data.url + '">\
                    <input type="hidden" value="'+ data.token + '" name="TBK_TOKEN"/>\
                </form>';
    form = $(html);
    $(document.body).append(form);
    form.submit();
    form.remove();
}

function show_next_fs(current_fs) {
    next_fs = current_fs.next();
    //Add Class Active
    $("#selector a").eq($("fieldset").index(next_fs)).addClass("kb-link-active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({ opacity: 0 }, {
        step: function (now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({ 'opacity': opacity });
        },
        duration: 600
    });
}


$(document).ready(function () {

    $('.js-basic-multiple').select2();
});