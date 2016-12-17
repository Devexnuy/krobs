jQuery(document).ready(function($) {
    //$('#SW_master .swiper-slide div.post:nth-child(6n+3)').addClass('first-post');
    var myElem = document.getElementById('SW_master');
    if (myElem !== null) {
        var a = new Swiper(".swiper-container");
        var z = document.getElementById("SW_master");
        if(z !== null) {
            z = z.childElementCount;
            a.slideTo(0);
        }
        // Add handler that will be executed only once
        a.on('slideChangeStart', function () {
            jQuery(function($){
                if ( $( "#SW_master" ).length ) {
                    $('#SW_master .swiper-slide-active').append( '<span class="load-more" style="clear: both;display: block"></span>' );
                    var id_loop = $('#SW_master .swiper-slide-active #id_loop').html();
                    localStorage.setItem(id_loop, "2");
                    localStorage.setItem("loop_active", id_loop);
                }
            });
        });
        // Menu custom click for categories
        var categories = [
            'en-portada',
            'sucesos-en-honduras',
            'homepage-sport',
            'otros-deportes',
            'noticias-internacionales',
            'hondurenos-por-el-mundo',
            'opinion',
            'opiniones-tiempo',
            'periodismo-ciudadanos-honduras',
            'autos'
        ];
        $('.menu-item').click(function(e){
            for (var i = 0; i < categories.length; i++) {
                var url = $(this).children('a').attr('href');
                if (url.indexOf(categories[i]) >= 0) {
                    e.preventDefault();
                    a.slideTo(i);
                }
            }
        });
    } else {
        $('.menu-item').click(function(e){
            e.preventDefault();
            var url = $(this).children('a').attr('href');
            localStorage.setItem('url_menu', url);
            location.replace(beloadmore.style);
        });
    }
});
