jQuery(function($){
    if($( "#SW_single" ).length) {
        // Init swiper
        var swiper = new Swiper('.swiper-container');
        swiper.slideTo($('.center-slide').index());
    }
    if ( $( "#SW_master" ).length ) {
        var button;
        $('#SW_master .swiper-slide-active').append( '<span class="load-more" style="clear: both;display: block"></span>' );
        // Create pagination loop
        var id_loop = $('#SW_master .swiper-slide-active #id_loop').html();
        localStorage.setItem(id_loop, "2");
        localStorage.setItem("loop_active", id_loop);
        var loading = false;
        var scrollHandling = {
            allow: true,
            reallow: function() {
                scrollHandling.allow = true;
            },
            delay: 500 //(milliseconds) adjust to the highest acceptable value
        };

        $(window).scroll(function(){
            button = getButton();
            if( ! loading && scrollHandling.allow ) {
                scrollHandling.allow = false;
                setTimeout(scrollHandling.reallow, scrollHandling.delay);
                var offset = $(button).offset().top - $(window).scrollTop();
                console.log(offset);
                if(600 > offset) {
                    loading = true;
                    var data = {
                        action: 'be_ajax_load_more',
                        nonce: beloadmore.nonce,
                        page: parseInt(localStorage.getItem(localStorage.getItem("loop_active"))),
                        id_loop: parseInt(localStorage.getItem("loop_active")),
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
                                console.log("Succes");
                                $('#SW_master .swiper-slide-active .load-more').before( res.data );
                                $('.krobs-post').addClass('post');
                                localStorage.setItem(localStorage.getItem("loop_active"), (parseInt(localStorage.getItem(localStorage.getItem("loop_active"))) + 1));
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
