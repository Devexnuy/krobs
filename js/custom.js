(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_ES/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

jQuery(document).ready(function($) {
    var myElem = document.getElementById('SW_master');
    var downloaded = [];
    if (myElem !== null) {
        var a = new Swiper(".swiper-container", {});
        a.on('onSlidePrevStart', function(swiper) {
            if ($('#SW_master .swiper-slide-active').hasClass('ajax')) {
                var cat_num = $('#SW_master .swiper-slide-active .cat-num').html();
                getNewPost(cat_num);
            } else {
                // Not ajax
            }
        });
        a.on('onSlideNextStart', function(swiper) {
            if ($('#SW_master .swiper-slide-active').hasClass('ajax')) {
                var cat_num = $('#SW_master .swiper-slide-active .cat-num').html();
                getNewPost(cat_num);
            } else {
                // Not ajax
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
                        social_lopez();
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

    /*
     *  Social Lopez feature
     */

    social_lopez();

    function social_lopez() {
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

    $('.tags a').click(function (e) {
        e.preventDefault();
    });
});
