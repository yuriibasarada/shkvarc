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
                parseInt(p.css('--duration')) * 100
            );
        }, 1000);
    }
    preloader();



// Загрузка фото в профиль
function handleFileSelect(evt) {
    var file = evt.target.files; // FileList object
    var f = file[0];
    // Only process image files.
    if (!f.type.match('image.*')) {
        alert("Image only please....");
    }
    var reader = new FileReader();
    // Closure to capture the file information.
    reader.onload = (function(theFile) {
        return function(e) {
            // Render thumbnail.
            var span = document.createElement('span');
            span.innerHTML = ['<img class="user-image" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
            span.innerHTML += ['<i class="fas fa-pen-fancy fa-4x" style="position: absolute"/>'].join('');
            document.getElementById('output').replaceChild(span, document.getElementById('output').children[0]);
        };
    })(f);
    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
}
document.getElementById('file').addEventListener('change', handleFileSelect, false);

});