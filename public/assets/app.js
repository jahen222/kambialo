$(document).ready(function () {

    $('#product-form').on('submit', function(){
        //alert('working...');
        $('#myModal').modal();
    });



    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $('input[type=radio]').on('change', function () {
        $('#sub-name').html($(this).data('name'));
        $('#sub-description').html($(this).data('description'));
        $('#sub-price').html($(this).data('price'));
		$('#sub-quote').html($(this).data('quote'));
		$('#sub-months').html($(this).data('months'));
    });

    $(".next").click(function () {
        current_fs = $(this).parents('fieldset:first');
        show_next_fs(current_fs);
    });

    $(".previous").click(function () {

        current_fs = $(this).parents('fieldset:first');
        previous_fs = $(this).parents('fieldset:first').prev();

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
        $('form').submit();
        /*return false;*/
    })

    $(':input').on('change', function () {
        $(this).nextAll('.text-danger').html('');
        $(this).parents('.form-group').nextAll('.text-danger').html('');
    });
});

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
    $('.datepicker').datepicker({
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd-mm-yy',
        maxDate: 0
    });
});