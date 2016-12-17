jQuery(function($){
    $('body').find('.carousel-wrapper').slick({
        swipe: false,
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 2,
        centerMode: true,
        variableWidth: true
    });

    if($( '#SW_single' ).length) {
        var first_load = false;
        var auto_slide = false;
        var downloaded = [];
        var swiper = new Swiper('.swiper-container', {
            onSlidePrevStart(swiper) {
                console.log('previous');
                nextPost(getPostID());
            },
            onSlideNextStart(swiper) {
                console.log('next');
                prevPost(getPostID());
            },
            initialSlide: 2,
            observer: true,
        });
        var post_id = $('.swiper-slide .single-id').html();

        nextPost(post_id);
        //prevPost(post_id);

        function prevPost(post_id) {
            if (!downloaded[post_id] == true || first_load == false) {
                downloaded[post_id] = true;
                first_load = true;
                var data = {
                    action: 'get_previous_post_id',
                    post_id: post_id
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
                        $('#SW_single .swiper-wrapper').append(res.data);
                        $('.krobs-post').addClass('post');
                        //swiper.onResize();
                        $(".carousel-wrapper").not('.slick-initialized').slick({
                            swipe: false,
                            dots: true,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 1,
                            centerMode: true,
                            variableWidth: true
                        });
                    }
                });
            } else {
                console.log('Ya fue cargado.');
            }
        }

        function nextPost(post_id) {
            if (!downloaded[post_id] == true) {
                downloaded[post_id] = true;
                var data = {
                    action: 'get_next_post_id',
                    post_id: post_id
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
                        $('#SW_single .swiper-wrapper').prepend(res.data);
                        $('.krobs-post').addClass('post');
                        swiper.onResize();
                        $(".carousel-wrapper").not('.slick-initialized').slick({
                            swipe: false,
                            dots: true,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 1,
                            centerMode: true,
                            variableWidth: true
                        });
                        if (auto_slide == false) {
                            swiper.slideTo($('.center-slide').index(), 0);
                            auto_slide = true;
                        }
                    }
                });
            } else {
                console.log('Ya fue cargado.');
            }
        }

        function getPostID() {
            return $('#SW_single .swiper-slide-active .single-id').html();
        }
    }
    // Loop home
    if ( $( "#SW_master" ).length ) {
        // Add custom style even 6 post
        $('div.krobs-post:nth-child(6n+3)').addClass('first-post');
        // Register ID post an pagination
        var froot_loops = {};
        var button;
        var loading = false;
        var scrollHandling = {
            allow: true,
            reallow: function() {
                scrollHandling.allow = true;
            },
            delay: 500 //(milliseconds) adjust to the highest acceptable value
        };
        function customStylepost() {
            $('#SW_master .swiper-slide-active div.krobs-post:nth-child(6n+3)').addClass('first-post');
        }
        $(window).scroll(function(){
            button = getButton();
            if( ! loading && scrollHandling.allow ) {
                scrollHandling.allow = false;
                setTimeout(scrollHandling.reallow, scrollHandling.delay);
                var offset = $(button).offset().top - $(window).scrollTop();
                console.log(offset);
                if(1000 > offset) {
                    loading = true;
                    var active_loop = $('#SW_master .swiper-slide-active #id_loop').html();
                    if (!froot_loops[active_loop]) {
                        froot_loops[active_loop] = 2;
                    } else {
                        froot_loops[active_loop] += 1;
                    }
                    console.log(active_loop + ' : '  +froot_loops[active_loop]);
                    var data = {
                        action: 'be_ajax_load_more',
                        nonce: beloadmore.nonce,
                        page: froot_loops[active_loop],
                        id_loop: active_loop,
                        query: beloadmore.query
                    };
                    $.ajax(beloadmore.url, { data: data,
                        type: "POST",
                        beforeSend: function() {
                            $('#SW_master .swiper-slide-active .load-more').before( '<p class="loading-text"><img width="60" height="auto" src="' + beloadmore.style + '/wp-content/uploads/2016/12/ring-alt.gif" alt="h"></p>');
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                        },
                        success: function(res) {
                            $('.loading-text').remove();
                            if( res.success) {
                                console.log('Success');
                                $('#SW_master .swiper-slide-active .load-more').before( res.data );
                                $('.krobs-post').addClass('post');
                                setInterval(customStylepost, 10);
                                loading = false;
                            } else {
                                console.log(res);
                            }
                        }
                    });

                } else {
                    // Not offset
                }
            }
        });
        function getButton() {
            return button = $('#SW_master .swiper-slide-active .load-more');
        }
    }
});
