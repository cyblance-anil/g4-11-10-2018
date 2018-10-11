function sliderResize(){
    var WiWidth = jQuery(window).width();
    var HeHeight = jQuery('#header').innerHeight();
    var sliderHeight = jQuery('#bootstrap-touch-slider').innerHeight();
    var inCHi = sliderHeight - HeHeight;
    jQuery('.SlideContainer').css('height',inCHi+'px');
    jQuery('.SlideContainer h2').fadeIn();
}
jQuery(function(){
    jQuery(window).resize(function(){
        sliderResize();
    });
});
jQuery(document).ready(function() {
    jQuery('.DataTable').DataTable({
        "paging": false
    });
});
jQuery(window).load(function(){
    sliderResize();
	jQuery('.share_buttons').css('left', -jQuery('.share_buttons').width());
	jQuery('.share_button').toggle(
		function() {
			var $lefty = jQuery(this).next('.share_buttons');
			$lefty.animate({
				left: jQuery(this).width()
			});
		},
		function() {
			var $lefty = jQuery(this).next('.share_buttons');
			$lefty.animate({
				left: -$lefty.outerWidth()
			});
		}
	);
});

jQuery(window).scroll(function() {
    if (jQuery(window).width() <= 992) {
        if (jQuery(this).scrollTop() > 100) {
            jQuery('#header').addClass("f-nav");
            jQuery('#header').addClass("f-nav");
            sliderResize();
        } else {
            jQuery('#header').removeClass("f-nav");
            sliderResize();
        }
    } else {
        if (jQuery(this).scrollTop() > 112) {
            jQuery('#header').addClass("f-nav");
            sliderResize();
        } else {
            jQuery('#header').removeClass("f-nav");
            sliderResize();
        }
    }
});


jQuery(document).ready(function(){
	jQuery(".toggle_title").toggle(
		function() {
			jQuery(this).addClass('toggle_active');
			jQuery(this).next('.toggle_content').slideDown("fast");
		},
		function() {
			jQuery(this).removeClass('toggle_active');
			jQuery(this).next('.toggle_content').slideUp("fast");
		}
	);
	jQuery(".accordion_title").click(
		function() {
			jQuery(this).siblings('.accordion_content').slideUp("fast");
			jQuery(this).siblings('.accordion_title').removeClass('accordion_active');
			if(jQuery(this).hasClass('accordion_active')) {
				jQuery(this).removeClass('accordion_active');
			} else {
				jQuery(this).addClass('accordion_active');
				jQuery(this).next('.accordion_content').slideDown("fast");
			}
		}
	);
	jQuery('a.tab').each(function(index) {
		jQuery(this).attr('id', 'tab' + index);
		jQuery('div.tab_content').eq(index).attr('id', 'tab' + index);
		if(jQuery(this).parent('li').hasClass('current')) {
			jQuery('div.tab_content').eq(index).css('left', '0');
			jQuery('div.tab_content').eq(index).css('position', 'relative');
			jQuery('div.tab_content').eq(index).show();
		}
	});
	jQuery("a.tab").click(
		function(event) {
			event.preventDefault();
			jQuery(this).parents('ul').children('li.current').removeClass('current');
			jQuery(this).parent('li').addClass('current');
			jQuery(this).parents('ul').children('li').each(function() { jQuery('div#' + jQuery(this).children('a').attr('id')).hide(); });
			jQuery('div#' + jQuery(this).attr('id')).css('left', '0');
			jQuery('div#' + jQuery(this).attr('id')).css('position', 'relative');
			jQuery('div#' + jQuery(this).attr('id')).show();
		}
	);
	jQuery("div.works-scroller").hover(
		function() {
			if(jQuery.browser.msie && jQuery.browser.version < "9.0") {
				jQuery(this).find('ul.fancy_nav').show();
			}
			else {
				jQuery(this).find('ul.fancy_nav').fadeIn();
			}
		},
		function() {
			if(jQuery.browser.msie && jQuery.browser.version < "9.0") {
				jQuery(this).find('ul.fancy_nav').hide();
			}
			else {
				jQuery(this).find('ul.fancy_nav').fadeOut();
			}
		}
	);
	jQuery('#search_btn').toggle(
		function() {
			jQuery('#search').animate({
				right: 0
			});
		},
		function() {
			jQuery('#search').animate({
				right: -jQuery('#search_wrapper').outerWidth()
			});
		}
	);
	init_like_this();
});

jQuery(function() {
	jQuery('ul.sf-menu').superfish({ delay: 300, animation: { height:'show' }, speed: 'normal' });
});

jQuery(function(){
    jQuery(".tiptip").tipsy();
});

// source: http://www.quirksmode.org/js/cookies.html
function createCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days*24*60*60*1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}
function eraseCookie(name) {
	createCookie(name, "", -1);
}

function init_like_this() {
	jQuery(".like_this").click(function(event) {
		event.preventDefault();
		if(typeof $qsdata == 'undefined') {
			var qs = false;
		}
		else {
			var qs = true;
		}
		var id = jQuery(this).attr("id");
		var cookie = readCookie(id);
		if(cookie == null) {
			var mode = 'update';
			jQuery(this).removeClass('fancy_likes');
			jQuery(this).addClass('fancy_likes_you_like');
			if(qs) {
				$qsdata.find('#'+id).removeClass('fancy_likes');
				$qsdata.find('#'+id).addClass('fancy_likes_you_like');
			}
			createCookie(id, id, 9999);
		}
		else {
			var mode = 'delete';
			jQuery(this).removeClass('fancy_likes_you_like');
			jQuery(this).addClass('fancy_likes');
			if(qs) {
				$qsdata.find('#'+id).addClass('fancy_likes');
				$qsdata.find('#'+id).removeClass('fancy_likes_you_like');
			}
			eraseCookie(id);
		}
		id = id.split("like-");
		jQuery.ajax({
			type: "POST",
			url: "index.php",
			data: "likepost=" + id[1] + "&mode=" + mode,
			success: function(data) {
				data = data.split("|");
				jQuery("#like-" + id[1]).attr('title', data[0]);
				jQuery("#like-" + id[1]).html(data[1]);
				if(qs) {
					$qsdata.find('#like-'+id[1]).attr('title', data[0]);
				}
			}
		});
		return false;
	});
}
jQuery(function(cash) {

});
jQuery(document).ready(function(cash) {
	
	jQuery(".search-box-onscroll").click(function(){
		jQuery(".Search-from").toggle();
	});
    jQuery("#Mobile_nav").click(function() {
        if (jQuery(".section_navbar").is(":hidden")) {
            jQuery(".section_navbar").show();
            jQuery('.section_navbar').animate({
                right: '0px'
            });
            jQuery('#main_wrapper, #header').animate({
                'right': "260px"
            });
            jQuery(".section_navbar").show();
            jQuery(this).addClass('close_menu');
        } else {
            jQuery('#main_wrapper, #header').animate({
                right: '0px'
            });
            jQuery('.section_navbar').animate({
                right: '-260px'
            }, function() {
                jQuery('.section_navbar').hide();
            });
            jQuery(this).removeClass('close_menu');
        }
    });
    jQuery('#navbar').click(function(event){   
        event.stopPropagation();
    });	
    jQuery('body').click(function() {
        if (jQuery(".dy-desktop .sub-menu").is(":visible")) {
            jQuery('.dy-desktop .sub-menu').fadeOut();
            jQuery( "ul.dy-desktop > li").removeClass('active');
        }
        if (jQuery(".onscroll-menu .Search-from").is(":visible")) {
            jQuery('.onscroll-menu .Search-from').fadeOut();
        }
    });
});

jQuery(window).load(function(cash) {
	jQuery('#News-Slider, #blog-Slider').owlCarousel({
		loop: false,
		margin: 0,
		nav: true,
		dots: false,
		touchDrag: false,
		mouseDrag: false,
		responsive:{
			0: {
				items: 1
			},
			767: {
				items: 2
			},
			1024: {
				items: 3
			}
		}
	})
});
function navScroll(navId){
    var HeaderHi = jQuery('#header').innerHeight();
    jQuery('html, body').animate({
    scrollTop: jQuery(navId).offset().top - HeaderHi }, 'slow');

    jQuery('#Mobile_nav').removeClass('close_menu');
    jQuery('#main_wrapper, #header').animate({right: '0px'});
    jQuery('.section_navbar').animate({right: '-260px'}, function() {
        jQuery(this).hide();
    });
    setTimeout(function(){ 
       var HeaderHi = jQuery('#header').innerHeight();
        jQuery('html, body').animate({
        scrollTop: jQuery(navId).offset().top - HeaderHi }, 'slow');
    }, 200);
}
jQuery('.rounded-arrow').click(function () {
    var HeaderHi = jQuery('#header').innerHeight();
    var position = jQuery(".aboutus").offset().top - HeaderHi;
    jQuery("HTML, BODY").animate({
        scrollTop: position
    }, 1000);
});
jQuery(function (){
    jQuery('.dnd-carousel').each(function (){
        var $prev = jQuery(this).find('.carousel_prev');
        var $next = jQuery(this).find('.carousel_next');

        var $autoPlay = jQuery(this).data("autoplay") == '0' ? false : true;
        var $items = jQuery(this).data("items");
        var $effect = jQuery(this).data("effect");
        var $easing = jQuery(this).data("easing");
        var $duration = jQuery(this).data("duration");

        jQuery(this).find('ul').carouFredSel({
            prev: $prev,
            next: $next,
            width: '100%',
            play: true,
            auto: $autoPlay,
            scroll: {
                items: $items,
                fx: $effect,
                easing: $easing,
                duration: $duration,
            }
        });
    });
    var touchS = jQuery( "#bootstrap-touch-slider .item" ).length;
    if(touchS =='1'){
        jQuery( "#bootstrap-touch-slider .carousel-control" ).hide();
    }
});