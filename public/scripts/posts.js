$(document).ready(function () {
    $('.post').bind('click', function() {

        $(this).next().addClass('active');
    });

    $('.close').bind('click', function() {
        $('.detail').removeClass('active');
    });
});
