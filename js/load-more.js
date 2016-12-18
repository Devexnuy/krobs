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
            initialSlide: 2,
            observer: true
        });
        swiper.on('onSlidePrevStart', function(swiper) {
            // Previous
            nextPost(getPostID());
        });
        swiper.on('onSlideNextStart', function(swiper) {
            // Next
            prevPost(getPostID());
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
                                $('#SW_master .swiper-slide-active .load-more').before( res.data );
                                $('.krobs-post').addClass('post');
                                setInterval(customStylepost, 10);
                                social_lopez();
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
        function social_lopez() {
            console.log('social lopez');
            // Close modal
            $('.close a').click(function (e) {
                e.preventDefault();
                $('.social-lopez').hide('slow');
            });

            // Open modal
            $('.sharing-button a').click(function (e) {
                e.preventDefault();
                // Get data
                var category  = $('.swiper-slide-active .main-category').html();
                var title     = $(this).parent(".sharing-button").parent('.post-sharing').prev('.post-title').children('.the-title').text();
                var permalink = $(this).parent(".sharing-button").parent('.post-sharing').prev('.post-title').prev('.post-media').find('a').attr('href');
                var image     = $(this).parent(".sharing-button").parent('.post-sharing').prev('.post-title').prev('.post-media').find('a').find('img').attr('src')
                // Set data
                $('.title .category').html(category);
                $('.title h3').html(title);
                $('.featured-image img').attr('src', image);
                // Facebook settings
                $('.facebook a').attr('href', 'https://www.facebook.com/share.php?u=' + permalink);
                var token = '1297971650284394|2449c08a82dd4bbe5fcfce1ccd49fc0d';
                var url = permalink;
                $.ajax({
                    url: 'https://graph.facebook.com/v2.8/',
                    dataType: 'jsonp',
                    type: 'GET',
                    data: {access_token: token, id: url},
                    before: function () {
                        console.log('before');
                    },
                    success: function(data){
                        var share_count = data.share;
                        if (share_count) {
                            $('.facebook .number-facebook').html(data.share.share_count);
                        } else {
                            $.post(
                                'https://graph.facebook.com',
                                {
                                    id: url,
                                    scrape: true
                                },
                                function(response){
                                    $.ajax({
                                        url: 'https://graph.facebook.com/v2.8/',
                                        dataType: 'jsonp',
                                        type: 'GET',
                                        data: {access_token: token, id: url},
                                        before: function () {
                                            console.log('before');
                                        },
                                        success: function(data){
                                            var share_count = data.share;
                                            if (share_count) {
                                                $('.facebook .number-facebook').html(data.share.share_count);
                                            } else {
                                                $.post(
                                                    'https://graph.facebook.com',
                                                    {
                                                        id: url,
                                                        scrape: true
                                                    },
                                                    function(response){

                                                    }
                                                );
                                            }

                                        },
                                        error: function(data){
                                            console.log(data); // send the error notifications to console
                                        }
                                    });
                                }
                            );
                        }

                    },
                    error: function(data){
                        console.log(data); // send the error notifications to console
                    }
                });
                // Twitter settings
                $('.twitter a').attr('href', 'https://twitter.com/intent/tweet?text=' + permalink);
                // Google + (experimental)
                $('.google a').attr('href', 'https://plus.google.com/share?url=' + permalink);
                $.ajax({
                    type: 'POST',
                    url: 'https://clients6.google.com/rpc',
                    processData: true,
                    contentType: 'application/json',
                    data: JSON.stringify({
                        'method': 'pos.plusones.get',
                        'id': permalink,
                        'params': {
                            'nolog': true,
                            'id': permalink,
                            'source': 'widget',
                            'userId': '@viewer',
                            'groupId': '@self'
                        },
                        'jsonrpc': '2.0',
                        'key': 'p',
                        'apiVersion': 'v1'
                    }),
                    success: function(response) {
                        $('.google .number-google').html(response.result.metadata.globalCounts.count);
                        console.log(response.result.metadata.globalCounts.count);
                    },
                    error: function (e) {
                        console.log('error');
                        console.log(e);
                    }
                });
                // Whats app settings
                $('.whatsapp a').attr('href', 'whatsapp://send?text=' + title + ' ' + permalink);
                // Show modal
                $('.social-lopez').show('slow');
            });
        }
    }
});
