//<!-- Ajax script for form validation -->
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#data_form').on('submit', function (e) {
    e.preventDefault();
    data = $(this).serialize();
    url = $(this).attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (data) {
            console.log(data);
            if ($.isEmptyObject(data.errors)) {
                console.log(data.success);
                $('#data_form')[0].reset();
                $('.text-danger').remove();
                $('.form-group').removeClass('has-error').removeClass('has-success');
                $('.print-success-msg').html(data.success);
                $('.print-success-msg').css('display', 'block');
            } else {
                printMessageErrors(data.errors);
            }
        }
    });
});

function printMessageErrors(msg) {
    $('.form-group').removeClass('has-error').find('.text-danger').remove();
    $.each(msg, function (key, value) {
        var element = $('#' + key);
        element.closest('div.form-group')
                .addClass(value.length > 0 ? 'has-error' : 'has-success');
        $('.control-label').css('color', '#797979');
        element.after('<span class="text-danger"><span class="glyphicon glyphicon-exclamation-sign text-danger"></span> ' + value + ' < /span>');
    });
}
//<!-- Ajax -->

//owl carousel
$(document).ready(function () {
    $("#owl-demo").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        autoPlay: true

    });
});
//custom select box

$(function () {
    $('select.styled').customSelect();
});