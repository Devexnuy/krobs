jQuery(document).ready(function($) {
    var myElem = document.getElementById('SW_master');
    var downloaded = [];
    if (myElem !== null) {
        if ($('.swiper-container').length) {
            var a = new Swiper(".swiper-container", {});
            a.on('onSlidePrevStart', function(swiper) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                if ($('#SW_master .swiper-slide-active').hasClass('ajax')) {
                    var cat_num = $('#SW_master .swiper-slide-active .cat-num').html();
                    getNewPost(cat_num);
                } else {
                    // Not ajax
                }
            });
            a.on('onSlideNextStart', function(swiper) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                if ($('#SW_master .swiper-slide-active').hasClass('ajax')) {
                    var cat_num = $('#SW_master .swiper-slide-active .cat-num').html();
                    getNewPost(cat_num);
                } else {
                    // Not ajax
                }
            });
            a.slideTo(0);
            // Add handler that will be executed only once
            a.on('slideChangeStart', function () {
                jQuery(function($){
                    if ( $( "#SW_master" ).length ) {
                        $('#SW_master .swiper-slide-active').append( '<span class="load-more" style="clear: both;display: block"></span>' );
                    }
                });
            });
        } 
        
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
                        social_lopez();
                    }
                });
            } else {
                // Was loaded.
            }
        }

        // Menu custom click for categories
        var categories = [
            'noticias-de-honduras',
            'avances-de-honduras',
            'noticias-de-politica-en-honduras',
            'sucesos-en-honduras',
            'noticias-de-deportes-en-honduras',  
            'noticias-internacionales',
            'opinion',
            'periodismo-ciudadanos-honduras',
            'autos'
        ];
        if (localStorage.url_menu) {
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
        // single menu
        $('.menu-item').click(function(e){
            e.preventDefault();
            var url = $(this).children('a').attr('href');
            localStorage.setItem('url_menu', url);
            location.replace(beloadmore.style);
        });

        // Call function to enable social lopez plugin
        social_lopez_single();
    }

    /*
     *  Social Lopez feature
     */

    social_lopez();

    /*
     * Set and share data on single pages.
     */

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

    $('.tags a').click(function (e) {
        e.preventDefault();
    });
    $('.post-meta ul li a').click(function (e) {
        e.preventDefault();
    });
});
