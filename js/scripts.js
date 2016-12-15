// jpreLoader   ----------------------------------------
if(krobs_obj.show_loader == '1'){
	jQuery("#main").jpreLoader({
	    loaderVPos: "50%",
	    autoClose: true
	}, function() {
	    jQuery("#main").animate({
	        opacity: "1"
	    }, {
	        queue: false,
	        duration: 700,
	        easing: "easeInOutQuad"
	    });
	});

}else{
	jQuery("#main").animate({
        opacity: "1"
    }, {
        queue: false,
        duration: 0,
        easing: "easeInOutQuad"
    });
}

// functions   ----------------------------------------
function initKrobs() {
    "use strict";
    var myElem = document.getElementById('SW_master');
    if (myElem !== null) {
        var a = new Swiper(".swiper-container", {
            speed: 1e3,
            initialSlide: 0,
            onSlideChangeStart: function(b) {
                jQuery("nav .active").removeClass("active");
                jQuery("nav li").eq(a.activeIndex).addClass("active");
                jQuery(".slide_container").animate({
                    scrollTop: 0
                }, {
                    queue: false,
                    duration: 1,
                    easing: "easeInOutQuad"
                });
                var d = jQuery(window).width();
                if (d < 979) setTimeout(function() {
                    c();
                }, 600);
                var scroll_nav_index = window.scroll_nav_index ? window.scroll_nav_index : 1;
                if (scroll_nav_index == b.activeIndex) setTimeout(function() {
                    jQuery(".scroll-nav").animate({
                        left: 0
                    });
                    jQuery(".scroll-nav a").each(function(a) {
                        var b = jQuery(this);
                        setTimeout(function() {
                            b.animate({
                                left: 0
                            }, {
                                queue: false,
                                duration: 500,
                                easing: "easeInOutQuart"
                            });
                        }, 250 * a);
                    });
                }, 1e3); else {
                    jQuery(".scroll-nav").animate({
                        left: "-50px"
                    });
                    jQuery(".scroll-nav a").each(function(a) {
                        var b = jQuery(this);
                        setTimeout(function() {
                            b.animate({
                                left: "-50px"
                            }, 300);
                        }, 150 * a);
                    });
                }
            }
        });
        var z = document.getElementById("SW_master");
        if(z !== null) {
            z = z.childElementCount;
            a.slideTo(Math.round(0));
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
    }
    jQuery("nav  li.swp").on("touchstart mousedown", function(b) {
        b.preventDefault();
        jQuery("nav .active").removeClass("active");
        jQuery(this).addClass("active");
        a.slideTo(jQuery(this).index());
    });
    jQuery("nav  li.swp").click(function(a) {
        a.preventDefault();
    });
    jQuery(".start-button").click(function(b) {
        b.preventDefault();
        a.slideTo(1);
    });
    jQuery(".gw").click(function(b) {
        b.preventDefault();
        a.slideTo(2);
    });
    jQuery(".go-contact").click(function(b) {
        b.preventDefault();
        a.slideTo(3);
    });
    jQuery(".arrow-left").on("click", function(b) {
        b.preventDefault();
        a.slidePrev();
    });
    jQuery(".arrow-right").on("click", function(b) {
        b.preventDefault();
        a.slideNext();
    });
// scroll nav   ----------------------------------------
    jQuery(".scroll-nav a").bind("click", function(a) {
        a.preventDefault();
        jQuery(".slide_container").scrollTo(jQuery(this).attr("href"), 950, {
            easing: "swing",
            offset: -140,
            axis: "y"
        });
    });
// show hide navigation   ----------------------------------------
    function b() {
        jQuery("nav").fadeIn(10);
        setTimeout(function() {
            jQuery("nav").removeClass("vis");
        }, 10);
        jQuery(".btn-menu-wrapper").addClass("nav-rotade");
		var swiper_menu = new Swiper('.swiper-container-menu', {
	        speed: 400
	    });
    }
    function c() {
        jQuery("nav").addClass("vis");
        setTimeout(function() {
            jQuery("nav").fadeOut(10);
        }, 230);
        jQuery(".btn-menu-wrapper").removeClass("nav-rotade");
    }
    jQuery(".call-menu").click(function() {
        if (jQuery("nav").hasClass("vis")) b(); else c();
        return false;
    });
    jQuery(".tlt").textillate({
        loop: true,
        minDisplayTime: 2e3,
        initialDelay: 0,
        autoStart: true,
        "in": {
            effect: "flipInY",
            delayScale: 2.5,
            delay: 50,
            sync: false,
            shuffle: false,
            reverse: false
        },
        out: {
            effect: "flipOutY",
            delayScale: 2.5,
            delay: 50,
            sync: false,
            shuffle: false,
            reverse: false
        }
    });
// portfolio  ----------------------------------------
    jQuery("#folio_container").mixitup({
        targetSelector: ".box",
        effects: [ "fade", "rotateX" ],
        easing: "snap",
        transitionSpeed: 700,
        layoutMode: "grid",
        targetDisplayGrid: "inline-block",
        targetDisplayList: "block"
    });
    jQuery("#options li").click(function() {
        jQuery("#options li").removeClass("actcat");
        jQuery(this).addClass("actcat");
    });
// Magnific popup  ----------------------------------------
    jQuery(".popup-with-move-anim").magnificPopup({
        type: "ajax",
        alignTop: true,
        overflowY: "scroll",
        fixedContentPos: true,
        fixedBgPos: false,
        closeBtnInside: false,
        midClick: true,
        modal: true,
        removalDelay: 600,
        mainClass: "my-mfp-slide-bottom",
        callbacks: {
            ajaxContentAdded: function() {
                jQuery("#project-slider").owlCarousel({
                    navigation: true,
                    pagination: false,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    autoHeight: true,
                    singleItem: true
                });
            }
        }
    });
    jQuery(".popup-youtube, .popup-vimeo").magnificPopup({
        disableOn: 700,
        type: "iframe",
        removalDelay: 600,
        mainClass: "my-mfp-slide-bottom"
    });
    jQuery(".popup-gallery").magnificPopup({
        type: "image",
        tLoading: "Loading image #%curr%...",
        removalDelay: 600,
        mainClass: "my-mfp-slide-bottom",
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [ 0, 1 ]
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });
    jQuery(".image-popup").magnificPopup({
        type: "image",
        closeOnContentClick: true,
        removalDelay: 600,
        mainClass: "my-mfp-slide-bottom",
        image: {
            verticalFit: true
        }
    });
    jQuery(document).on("click", ".popup-modal-dismiss", function(a) {
        a.preventDefault();
        jQuery.magnificPopup.close();
    });
// folio hover   ----------------------------------------
    jQuery.fn.duplicate = function(a, b) {
        var c = [];
        for (var d = 0; d < a; d++) jQuery.merge(c, this.clone(b).get());
        return this.pushStack(c);
    };
     jQuery("<span class='scale-callback transition2'></span>").duplicate(6).appendTo(".folio-overlay ");
    jQuery(".box").hover(function() {
        var a = jQuery(this);
        var b = jQuery(this).find("div.folio-item");
        var c = jQuery(this).find(".folio-item span.fol-but");
        var d = jQuery(this).find(".folio-overlay span");
        var e = {
            queue: true,
            duration: 500,
            easing: "swing"
        };
        var f = {
            queue: true,
            duration: 900,
            easing: "easeInOutElastic"
        };
        if (a.hasClass("notvisible")) {
            b.stop(true, true).animate({
                opacity: "1"
            }, e);
            c.delay(350).animate({
                opacity: "1",
                bottom: "40%"
            }, f);
            setTimeout(jQuery.proxy(function() {
                d.each(function(a) {
                    var b = jQuery(this);
                    setTimeout(function() {
                        b.removeClass("scale-callback");
                    }, 50 * a);
                });
            }, this), 250);
            a.removeClass("notvisible");
        } else {
            b.stop(true, true).animate({
                opacity: "0"
            }, f);
            c.animate({
                opacity: "0",
                bottom: "-50%"
            }, e);
            setTimeout(jQuery.proxy(function() {
                d.each(function(a) {
                    var b = jQuery(this);
                    setTimeout(function() {
                        b.addClass("scale-callback");
                    }, 50 * a);
                });
            }, this), 250);
            a.addClass("notvisible");
        }
        return false;
    });
// owl carousel   ----------------------------------------
    var d = jQuery("#about-slider");
    d.owlCarousel({
        navigation: false,
        slideSpeed: 500,
        pagination: false,
        autoHeight: true,
        singleItem: true,
        touchDrag: false,
        mouseDrag: false
    });
    jQuery('.about-button').each(function(index){
        var bt = jQuery(this);
        bt.click(function() {
            d.trigger("owl.goTo", bt.data('key'));
            jQuery(".about-button").removeClass("cur");
            bt.addClass("cur");
            jQuery("div.skillbar-bg").each(function() {
                jQuery(this).find(".custom-skillbar").delay(600).animate({
                    width: jQuery(this).attr("data-percent")
                }, 1500);
            });
        });
    });
    // jQuery(".show-about").click(function() {
    //     d.trigger("owl.goTo", 0);
    //     jQuery(".show-res , .show-ser").removeClass("cur");
    //     jQuery(this).addClass("cur");
    // });
    // jQuery(".show-ser").click(function() {
    //     d.trigger("owl.goTo", 2);
    //     jQuery(".show-res, .show-about").removeClass("cur");
    //     jQuery(this).addClass("cur");
    // });
    var f = jQuery("#testimonials-slider");
    f.owlCarousel({
        navigation: false,
        slideSpeed: 500,
        pagination: false,
        autoHeight: true,
        singleItem: true,
        touchDrag: false,
        mouseDrag: true
    });
    jQuery(".testimonials-holder .next-slide").click(function() {
        f.trigger("owl.next");
    });
    jQuery(".testimonials-holder .prev-slide").click(function() {
        f.trigger("owl.prev");
    });

    jQuery(".testimonials-slider").each(function(index){
        var tes = jQuery(this);
        tes.owlCarousel({
            navigation: false,
            slideSpeed: 500,
            pagination: false,
            autoHeight: true,
            singleItem: true,
            touchDrag: false,
            mouseDrag: true
        });
        jQuery(".testimonials-holder .next-slide").click(function() {
            tes.trigger("owl.next");
        });
        jQuery(".testimonials-holder .prev-slide").click(function() {
            tes.trigger("owl.prev");
        });
    });

    // var g = jQuery("#clients-slider");
    // g.owlCarousel({
    //     navigation: false,
    //     slideSpeed: 500,
    //     pagination: true,
    //     autoHeight: true,
    //     items: 4,
    //     touchDrag: false,
    //     mouseDrag: true
    // });
    // jQuery(".clients-holder .next-slide").click(function() {
    //     g.trigger("owl.next");
    // });
    // jQuery(".clients-holder .prev-slide").click(function() {
    //     g.trigger("owl.prev");
    // });

    var g = jQuery(".clients-slider");
    g.owlCarousel({
        navigation: false,
        slideSpeed: 500,
        pagination: true,
        autoHeight: true,
        items: 4,
        touchDrag: false,
        mouseDrag: true
    });
    jQuery(".clients-holder .next-slide").click(function() {
        g.trigger("owl.next");
    });
    jQuery(".clients-holder .prev-slide").click(function() {
        g.trigger("owl.prev");
    });

    var h = jQuery(".about-image-slider");
    h.owlCarousel({
        navigation: false,
        slideSpeed: 500,
        pagination: false,
        autoHeight: true,
        singleItem: true,
        touchDrag: false,
        mouseDrag: true
    });
    jQuery(".about-image .next-slide").click(function() {
        h.trigger("owl.next");
    });
    jQuery(".about-image .prev-slide").click(function() {
        h.trigger("owl.prev");
    });
	jQuery('.clients-holder').css({height: jQuery('.to-top-holder').outerHeight(true)});

 	var prsls = jQuery(".rep-single-slider");

    prsls.owlCarousel({
        navigation: false,
        pagination: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        autoHeight: true,
        singleItem: true,
        touchDrag: true,
        mouseDrag: true
    });

	jQuery(".slide-holder .next-slide").click(function() {
         prsls.trigger("owl.next");
    });
    jQuery(".slide-holder .prev-slide").click(function() {
         prsls.trigger("owl.prev");
 	});
// twitter  ----------------------------------------
    if (jQuery("#twitter-feed").length) {
        // jQuery("#twitter-feed").tweet({
        //     username: "katokli3mmm",
        //     join_text: "auto",
        //     avatar_size: 0,
        //     count: 4
        // });
        jQuery("#twitter-feed").find("ul").addClass("twitter-slider");
        jQuery("#twitter-feed").find("ul li").addClass("item");
        var e = jQuery(".twitter-slider");
        e.owlCarousel({
            navigation: false,
            slideSpeed: 500,
            pagination: false,
            autoHeight: true,
            singleItem: true,
            touchDrag: false,
            mouseDrag: true
        });
        jQuery(".twitter-holder .next-slide").click(function() {
            e.trigger("owl.next");
        });
        jQuery(".twitter-holder .prev-slide").click(function() {
            e.trigger("owl.prev");
        });
    }
// Contact form  ----------------------------------------
    // jQuery("#contactform").submit(function() {
    //     var a = jQuery(this).attr("action");
    //     jQuery("#message").slideUp(750, function() {
    //         jQuery("#message").hide();
    //         jQuery("#submit").attr("disabled", "disabled");
    //         jQuery.post(a, {
    //             name: jQuery("#name").val(),
    //             email: jQuery("#email").val(),
    //             comments: jQuery("#comments").val()
    //         }, function(a) {
    //             document.getElementById("message").innerHTML = a;
    //             jQuery("#message").slideDown("slow");
    //             jQuery("#submit").removeAttr("disabled");
    //             if (null != a.match("success")) jQuery("#contactform").slideDown("slow");
    //         });
    //     });
    //     return false;
    // });
    // jQuery("#contactform input, #contactform textarea").keyup(function() {
    //     jQuery("#message").slideUp(1500);
    // });


// subscribe   ----------------------------------------
    // jQuery(".subscriptionForm").submit(function() {
    //     var a = jQuery("#subscriptionForm").val();
    //     jQuery.ajax({
    //         url: "php/subscription.php",
    //         type: "POST",
    //         dataType: "json",
    //         data: {
    //             email: a
    //         },
    //         success: function(a) {
    //             if (a.error) jQuery("#error").fadeIn(); else {
    //                 jQuery("#success").fadeIn();
    //                 jQuery("#error").hide();
    //             }
    //         }
    //     });
    //     return false;
    // });
    // jQuery("#subscriptionForm").focus(function() {
    //     jQuery("#error").fadeOut();
    //     jQuery("#success").fadeOut();
    // });
    // jQuery("#subscriptionForm").keydown(function() {
    //     jQuery("#error").fadeOut();
    //     jQuery("#success").fadeOut();
    // });
// services   ----------------------------------------
    jQuery(".services-holder a[data-ser=modal]").click(function(a) {
        a.preventDefault();
        var b = jQuery(this).attr("href");
        jQuery(b).fadeIn(500);
    });
    jQuery("<span class='closeser transition2'></span>").appendTo(".services-info");
    jQuery(".closeser").click(function() {
        jQuery(".services-info").fadeOut();
    });
    jQuery(".scroll-btn").on("click", function(a) {
        a.preventDefault();
        jQuery(".slide_container").animate({
            scrollTop: 0
        }, {
            queue: false,
            duration: 1e3,
            easing: "easeInOutQuad"
        });
    });
}
// ajax portfolio  ----------------------------------------
function initajaxjs() {
    jQuery("#project-slider").owlCarousel({
        navigation: true,
        pagination: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        autoHeight: true,
        singleItem: true,
        touchDrag: false,
        mouseDrag: true
    });
    jQuery(".elemajax").each(function(a) {
        var b = jQuery(this);
        setTimeout(function() {
            b.animate({
                top: "0",
                opacity: 1
            }, {
                duration: 1200,
                easing: "easeInOutQuart"
            });
        }, 350 * a);
        jQuery(".popup-gallery-ajax").magnificPopup({
            type: "image",
            tLoading: "Loading image #%curr%...",
            removalDelay: 600,
            mainClass: "my-mfp-slide-bottom",
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [ 0, 1 ]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    });
}

jQuery(window).load(function() {
    !function() {
        var a = jQuery("#project-page-holder");
        var b = jQuery(".open-project-link");
        index = b.length;
        jQuery(".open-project-link").click(function() {
            jQuery(".slide_container").scrollTo("#options", 600, {
                axis: "y"
            });
            if (jQuery(this).hasClass("actajax")) ; else {
                lastIndex = index;
                index = jQuery(this).index();
                b.removeClass("actajax");
                jQuery(this).addClass("actajax");
                var a = jQuery(this).find("a.open-project").attr("href") + " .item-data";
                jQuery("#project-page-data").animate({
                    opacity: 0
                }, 400, function() {
                    jQuery("#project-page-data").load(a, function(a) {
                        var b = jQuery(".helper");
                        var c = b.height();
                        jQuery("#project-page-data").css({
                            height: ""
                        });
                    });
                 	jQuery("#project-page-data").animate({
                        opacity: 1
                    }, 400);
                });
                jQuery("#project-page-holder").slideUp(600, function() {
                    jQuery("#project-page-data").css("visibility", "visible");
                }).delay(500).slideDown(1e3, function() {
                    jQuery("#project-page-data").fadeIn("slow", function() {
                        initajaxjs();
                    });
                });
            }
            return false;
        });
        jQuery("#project_close").on("click", function(a) {
            a.preventDefault();
            jQuery("#project-page-data").animate({
                opacity: 0
            }, 400, function() {
                jQuery("#project-page-holder").slideUp(400);
                jQuery(".project-page").find("iframe").remove();
            });
            jQuery(".slide_container").scrollTo("#options", 600, {
                axis: "y"
            });
            jQuery(".open-project-link").removeClass("actajax");
            return false;
        });
    }();
});
// map   ----------------------------------------
var map;

//var krobsmap = new google.maps.LatLng(40.761467, -73.956379);

function initialize() {
    var a = [ {
        featureType: "water",
        elementType: "all",
        stylers: [ {
            hue: "#cdcdcd"
        }, {
            saturation: -100
        }, {
            lightness: 18
        }, {
            visibility: "on"
        } ]
    }, {
        featureType: "landscape",
        elementType: "all",
        stylers: [ {
            hue: "#e8e8e8"
        }, {
            saturation: -100
        }, {
            lightness: 18
        }, {
            visibility: "on"
        } ]
    }, {
        featureType: "road",
        elementType: "all",
        stylers: [ {
            hue: "#fdfdfd"
        }, {
            saturation: -100
        }, {
            lightness: -1
        }, {
            visibility: "on"
        } ]
    }, {
        featureType: "road.local",
        elementType: "all",
        stylers: [ {
            hue: "#fdfdfd"
        }, {
            saturation: -100
        }, {
            lightness: -1
        }, {
            visibility: "on"
        } ]
    }, {
        featureType: "poi.park",
        elementType: "all",
        stylers: [ {
            hue: "#c0c0c0"
        }, {
            saturation: -100
        }, {
            lightness: -3
        }, {
            visibility: "on"
        } ]
    }, {
        featureType: "poi",
        elementType: "all",
        stylers: [ {
            hue: "#c0c0c0"
        }, {
            saturation: -100
        }, {
            lightness: -3
        }, {
            visibility: "on"
        } ]
    }, {
        featureType: "transit",
        elementType: "all",
        stylers: [ {
            hue: "#ffffff"
        }, {
            saturation: -100
        }, {
            lightness: -9
        }, {
            visibility: "on"
        } ]
    } ];
    var b = {
        zoom: 17,
        zoomControl: true,
        scaleControl: false,
        scrollwheel: false,
        disableDefaultUI: false,
        draggable: false,
        center: krobsmap,
        mapTypeControlOptions: {
            mapTypeIds: [ google.maps.MapTypeId.ROADMAP, "bestfromgoogle" ]
        }
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), b);
    var c = {
        name: "krobsmap"
    };
    var d = new google.maps.StyledMapType(a, c);
    map.mapTypes.set("bestfromgoogle", d);
    map.setMapTypeId("bestfromgoogle");
    var e = new google.maps.MarkerImage("images/marker.png", new google.maps.Size(94, 94), new google.maps.Point(0, 0), new google.maps.Point(94, 94));
    var f = new google.maps.LatLng(40.761467, -73.956379);
    var g = new google.maps.Marker({
        position: f,
        map: map,
        icon: e,
        zIndex: 3
    });
}
// init   ----------------------------------------
jQuery(document).ready(function() {
    initKrobs();
    if(jQuery('.error404').size()>0){
        jQuery('html').css('overflow','hidden');
        window_h = jQuery(window).height(),
        //jQuery('.single-page-title-holder').css('height',window_h);
        //jQuery('.single-page-bg').css('height',window_h);
        jQuery('.page-title').css('height',window_h);
        jQuery('.overlay').css('height',window_h);

        jQuery('.single-page').hide();
    }
    jQuery(".fitvids-container").fitVids({ customSelector: "iframe[src^='https://w.soundcloud.com']"});

    if(jQuery('.krobs-bg-player').size()> 0 ){
        //  definition of mobile browser------------------

        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };
        trueMobile = isMobile.any();
        // if not mobile ------------------


        if (trueMobile == null){
            jQuery(".krobs-bg-player").mb_YTPlayer();
        }
        if (trueMobile){
                jQuery('.mobile-bg').fadeIn(10);
                jQuery('.krobs-bg-player').remove();
        }
    }

    jQuery('.transition-slider').superslides({
        animation: 'fade',
        play: 10000
    });
    jQuery('.rep-slides').superslides({
        animation: 'fade',
        play: 4000
    });
});

function vc_carouselBehaviour($parent) {
    var $carousel = $parent ? $parent.find(".wpb_carousel") : jQuery(".wpb_carousel");
    $carousel.each(function () {
      var $this = jQuery(this);
      if ($this.data('carousel_enabled') !== true && $this.is(':visible')) {
        $this.data('carousel_enabled', true);
        var carousel_width = jQuery(this).width(),
          visible_count = getColumnsCount(jQuery(this)),
          carousel_speed = 500;
        if (jQuery(this).hasClass('columns_count_1')) {
          carousel_speed = 900;
        }
        /* Get margin-left value from the css grid and apply it to the carousele li items (margin-right), before carousele initialization */
        var carousele_li = jQuery(this).find('.wpb_thumbnails-fluid li');
        carousele_li.css({"margin-right":carousele_li.css("margin-left"), "margin-left":0 });

        jQuery(this).find('.wpb_wrapper:eq(0)').jCarouselLite({
          btnNext:jQuery(this).find('.next'),
          btnPrev:jQuery(this).find('.prev'),
          visible:visible_count,
          speed:carousel_speed
        })
          .width('100%');//carousel_width

        var fluid_ul = jQuery(this).find('ul.wpb_thumbnails-fluid');
        fluid_ul.width(fluid_ul.width() + 300);

        jQuery(window).resize(function () {
          var before_resize = screen_size;
          screen_size = getSizeName();
          if (before_resize != screen_size) {
            window.setTimeout('location.reload()', 20);
          }
        });
      }

    });
}
jQuery(document).ready(function($){
	if(krobs_obj.show_menu_start == '1'){
		var w_w = $(window).width();
	    if(w_w >= 960 ) {
	        $("nav").fadeIn(10);
	        setTimeout(function() {
	            $("nav").removeClass("vis");
	        }, 10);
	        $(".btn-menu-wrapper").addClass("nav-rotade");
	    }
	}
	$(".wpcf7-text,.wpcf7-email,.wpcf7-textarea").click(function(){$(this).select();});
});
