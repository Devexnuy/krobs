jQuery(function($){
    $('body').find('.carousel-wrapper').slick({
        swipe: false,
        dots: true,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
    });

    console.log('update');

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
            $("html, body").animate({ scrollTop: 0 }, "slow");
            social_lopez_single();
        });
        swiper.on('onSlideNextStart', function(swiper) {
            // Next
            prevPost(getPostID());
            $("html, body").animate({ scrollTop: 0 }, "slow");
            social_lopez_single();
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
                            slidesToShow: 2,
                            slidesToScroll: 2
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
                            slidesToShow: 2,
                            slidesToScroll: 2
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
        function social_lopez_single() {
            // Open modal, set data and share.
            $('.share a').click(function (e) {
                // Prevent event
                e.preventDefault();
                // Set counter on zero
                var facebook_count = 0;
                var google_count = 0;
                // Get all data for single post
                var category  = $('.swiper-slide-active .post-title .post-meta ul li > a').html();
                var title     = $('.swiper-slide-active .post-title h3').html();
                var permalink = $('.swiper-slide-active .post-media > a').attr('href');
                var image     = $('.swiper-slide-active .post-media > a img').attr('src');
                // Set all data
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
                            facebook_count = data.share.share_count;
                            console.log(facebook_count);
                            $('.facebook .number-facebook').html(data.share.share_count);
                            $('.shared-counts .number span').html(facebook_count + google_count);
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
                                                facebook_count = data.share.share_count;
                                                $('.facebook .number-facebook').html(data.share.share_count);
                                                $('.shared-counts .number span').html(facebook_count + google_count);
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
                        google_count = response.result.metadata.globalCounts.count;
                        $('.shared-counts .number span').html(facebook_count + google_count);
                        $('.google .number-google').html(response.result.metadata.globalCounts.count);
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

            // Close modal. When open the modal are reset the data.
            $('.close a').click(function (e) {
                e.preventDefault();
                $('.social-lopez').hide('slow');
            });
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
            if( ! loading && scrollHandling.allow && button.length) {
                scrollHandling.allow = false;
                setTimeout(scrollHandling.reallow, scrollHandling.delay);
                var offset = $(button).offset().top - $(window).scrollTop();
                var active_loop = $('#SW_master .swiper-slide-active #id_loop').html();
                console.log(offset);
                if(1000 > offset) {
                    loading = true;
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
                    if ($('#id_loop').length && active_loop != undefined) {
                        $.ajax(beloadmore.url, { data: data,
                            type: "POST",
                            beforeSend: function() {
                                $('#SW_master .swiper-slide-active .load-more').before( '<p class="loading-text"><img width="60" height="auto" src="' + beloadmore.style + '/wp-content/plugins/tiempo-mobil/img/ring-alt.gif" alt="h"></p>');
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
                                    setTimeout(function () {loading = false;}, 5000)
                                } else {
                                    console.log(res);
                                }
                            }
                        });
                    } else {
                        loading = false;
                    }
                } 
            }
        });
        function getButton() {
            return button = $('#SW_master .swiper-slide-active .load-more');
        }
        function social_lopez() {
            // Close modal
            $('.close a').click(function (e) {
                e.preventDefault();
                $('.social-lopez').hide('slow');
            });

            // Open modal
            $('.sharing-button a').click(function (e) {
                e.preventDefault();
                var facebook_count = 0;
                var google_count = 0;
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
                            facebook_count = data.share.share_count;
                            console.log(facebook_count);
                            $('.facebook .number-facebook').html(data.share.share_count);
                            $('.shared-counts .number span').html(facebook_count + google_count);
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
                                                facebook_count = data.share.share_count;
                                                $('.facebook .number-facebook').html(data.share.share_count);
                                                $('.shared-counts .number span').html(facebook_count + google_count);
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
                        google_count = response.result.metadata.globalCounts.count;
                        $('.shared-counts .number span').html(facebook_count + google_count);
                        $('.google .number-google').html(response.result.metadata.globalCounts.count);
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
