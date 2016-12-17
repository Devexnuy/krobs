jQuery(document).ready(function($) {
    var myElem = document.getElementById('SW_master');
    var downloaded = [];
    if (myElem !== null) {
        var a = new Swiper(".swiper-container", {
            onSlidePrevStart(swiper) {
                if ($('#SW_master .swiper-slide-active').hasClass('ajax')) {
                    var cat_num = $('#SW_master .swiper-slide-active .cat-num').html();
                    getNewPost(cat_num);
                } else {
                    // Not ajax
                }
            },
            onSlideNextStart(swiper) {
                if ($('#SW_master .swiper-slide-active').hasClass('ajax')) {
                    var cat_num = $('#SW_master .swiper-slide-active .cat-num').html();
                    getNewPost(cat_num);
                } else {
                    // Not ajax
                }
            }
        });

        function getNewPost(counter) {
            if (!downloaded[counter] == true) {
                downloaded[counter] = true;

                var data = {
                    action: 'get_home_loop',
                    cat_position: counter.slice(-1)
                };
                $.ajax(beloadmore.url, { data: data,
                    type: "POST",
                    beforeSend: function() {
                        // Before send
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(errorThrown);
                    },
                    success: function(res) {
                        $('.' + counter + ' .loading-home').remove();
                        $('.' + counter + ' .cat-num').remove();
                        $('.' + counter).prepend(res.data);
                        $('.krobs-post').addClass('post');
                        $('#SW_master .swiper-slide div.post:nth-child(6n+3)').addClass('first-post');
                    }
                });
            } else {
                // Was loaded.
            }
        }

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
        if (localStorage.url_menu) {
            console.log('extern_menu');
            for (var i = 0; i < categories.length; i++) {
                var url = localStorage.getItem('url_menu');
                if (url.indexOf(categories[i]) >= 0) {
                    a.slideTo(i);
                }
            }
            localStorage.removeItem('url_menu');
        }
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
