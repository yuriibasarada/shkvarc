$(document).ready(function () {
//    ГЛАВНАЯ СТРАНИЦА  //
    //МЕНЮ
    $('.menu-toggle').on('click', function(){
        $('body').toggleClass('open');
    });

    //PRELOADER
    function preloader()
    {
        setInterval(()=> {
            let p = $('.preloader');

            p.css('opacity', 0);

            setInterval(
                () => p.remove(),
                parseInt(p.css('--duration')) * 500
            );
        }, 1000);
    }
    preloader();
});