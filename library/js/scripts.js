/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();

  $("#main_nav-menu_button").on('click', function(event) {
    event.preventDefault();
    $("header").toggleClass('js-menu-active'); 
    $("header nav").toggleClass('nav-collapsed'); 
    if($('header').hasClass('js-menu-active')) { 

      if($(document).width() > 768 && $(document).width() < 1030) {
        $("header").animate({ width: "-=300"}, 300);
      } else if($(document).width() > 520 && $(document).width() <= 768) {
        $("header").animate({ width: "-=260" }, 300); 
      } else {
        $("header").animate({ width: "-=200" }, 300); 
      }
      $('header nav > #menu-header-menu').append("<li class='last-option-parent'><a href='#'>Back</a></li>");
      $("ul#menu-header-menu li.last-option-parent").on('click', function(event) {
          event.preventDefault(); 
          $(this).parent("ul#menu-header-menu").remove("li.last-option-parent");
          $("header").css({width: "100%"}); 
          $("header").removeClass('js-menu-active'); 
          $("header nav").removeClass("nav-collapsed");
        });

    } else {
      $("header").css({width: "100%"}); 
      $("header ul.sub-menu.nav-opened").animate({ left: "-300px" }, 300); 
      $("header ul.sub-menu.nav-opened").removeClass("nav-opened"); 
    }
  });

  $("#hotel_nav-menu_button").on('click', function(event){
    event.preventDefault();
    $("nav.hotel-submenu ul.fp-submenu-menu").slideToggle('fast');
  });

  if($(document).width() <= 768) {
    $("ul.fp-submenu-menu li").each( function() {
      if($(this).has("ul.sub-menu")) {
        $(this).click(function(event) {
          if(!$(this).hasClass('open-submenu') && $(this).children("ul.sub-menu").length) {
            event.preventDefault(); 
            $("ul.fp-submenu-menu li").removeClass('open-submenu'); 
            $(this).find("ul.sub-menu").slideDown('fast'); 
            $(this).addClass('open-submenu');
          }
        });
      }
    });
    $('#content h3[class^=header]').each(function() { $(this).insertBefore(jQuery('#content .hotel-tabs.tablet-'+$(this).attr('class').slice(-1))) });
  }

  if($(document).width() > 768) {
    $('document').remove('nav ul li.last-option'); 
  }

  if($(document).width() <= 1030) { 
    $("header nav > ul li a").click(function(event) { 
      if($(this).parent().find('ul.sub-menu').length) {
      event.preventDefault(); 
      $(this).parent("li").find("ul.sub-menu").toggleClass("nav-opened"); 
      $(".last-option-parent").remove();
      if($(this).parent("li").find("ul.sub-menu.nav-opened").length) {
        $(this).parent("li").find("ul.sub-menu.nav-opened").append("<li class='last-option'><a href='#'>Back</a></li>");
        $("ul.sub-menu li.last-option").on('click', function(event) {
          event.preventDefault(); 
          $(this).parent("ul.sub-menu.nav-opened").remove("ul.sub-menu li.last-option");
          $(this).parent("ul.sub-menu.nav-opened").animate({ left: "-300px"}, 300);
          $(this).parent("ul.sub-menu.nav-opened").removeClass('nav-opened'); 
          $('header nav > #menu-header-menu').append("<li class='last-option-parent'><a href='#'>Back</a></li>");
          $("ul#menu-header-menu li.last-option-parent").on('click', function(event) {
              event.preventDefault(); 
              $(this).parent("ul#menu-header-menu").remove("li.last-option-parent");
              $("header").css({width: "100%"}); 
              $("header").removeClass('js-menu-active'); 
              $("header nav").removeClass("nav-collapsed");
            });
        });
        $(this).parent("li").find("ul.sub-menu.nav-opened").animate({ left: "0px"}, 300); 
      } else {
        $(this).parent("li").find("ul.sub-menu.nav-opened").remove("ul.sub-menu li.last-option");
        $(this).parent("li").find("ul.sub-menu.nav-opened").animate({ left: "-300px"}, 300);
      }
      }
    }); 
    $('.booking-form-desktop .bookingbox-flex-bookbutton').click(function(event) {
      $("#right-header .booking-container").toggleClass('hovered'); 
    });
  }

  if($('body.subpage #content nav#fp-submenu').length) {
    $('header.header').css('position', 'relative'); 
  }

  $(window).scroll(function () {
    if( 100 <= $(window).scrollTop() && $(window).width() > 768 ) {
      $('#right-header .discovery').hide(); 
    } else if( $(window).width() > 820) {
      $('#right-header .discovery').show(); 
    }

    if($('body.subpage #content nav#fp-submenu').length) {
      if($('body.page #content .top-section').height() <= $(window).scrollTop()) {
        $('body.subpage #content nav#fp-submenu').css({ position: "fixed", top: "0px", width: "100%", 'z-index': "102" }); 
        $('#inner-content').append($('#right-header').addClass('sticky'));
      }
      else {
        $('body.subpage #content nav#fp-submenu').css({ position: "relative", top: "inherit", width: "100%", 'z-index': "102" }); 
        $('header.header #inner-header .container').append($('#right-header').removeClass('sticky'));
      }
    }
  });

  if($("section.parallax-move").length && $(document).width() >= 1030) {
    var image_url = $('section.parallax-move').css('background'), image;

    if(image_url == null) { var image_url = $('section.parallax-move').css('background-image'); }
  
    if(image_url != null && image_url != "") {
      // Remove url() or in case of Chrome url("")
      image_url = image_url.match(/url\("?'?\s*(.+?)\s*"?'?\)/);

        if (image_url[1]) {
            image_url = image_url[1];
            image = new Image();

            // just in case it is not already loaded
            $(image).load(function () {
                image.src = image_url;
                $("section.parallax-move").height(image.height - 120); 
            });

            image.src = image_url;
            $("section.parallax-move").height(image.height - 120); 
        }
      }
  }

  if($('#content form.navis-newsletter').length) { 
    $('form.navis-newsletter').attr('action','https://www.thenavisway.com/reach/WebServicePost/SubscribeToList.aspx'); 
    $('form.navis-newsletter').attr('method', 'get'); 
    $('form.navis-newsletter').attr('target','_blank'); 
    $('form.navis-newsletter input[type="checkbox"]').attr('name', 'SubscriptionLists'); 
    $('form.navis-newsletter input[type="hidden"]:first').attr('name', 'account'); 
    $('form.navis-newsletter input[name="input_2"]').attr('name', 'password'); 
    $('form.navis-newsletter input[name="input_3"]').attr('name', 'RedirectURL'); 
    $('form.navis-newsletter input[name="input_5"]').attr('name', 'name'); 
    $('form.navis-newsletter input[name="input_6"]').attr('name', 'email'); 
  }

  if($('#content form.navis-newsletter-tmc').length) { 
    $('form.navis-newsletter').attr('action','https://www.thenavisway.com/reach/WebServicePost/SubscribeToList.aspx'); 
    $('form.navis-newsletter').attr('method', 'get'); 
    $('form.navis-newsletter').attr('target','_blank'); 
    $('form.navis-newsletter input[type="checkbox"]').attr('name', 'SubscriptionLists'); 
    $('form.navis-newsletter input[type="hidden"]:first').attr('name', 'account'); 
    $('form.navis-newsletter input[name="input_2"]').attr('name', 'password'); 
    $('form.navis-newsletter input[name="input_3"]').attr('name', 'RedirectURL'); 
    $('form.navis-newsletter input[name="input_5"]').attr('name', 'name'); 
    $('form.navis-newsletter input[name="input_6"]').attr('name', 'email'); 
  }

  /**
   * For tabs on a page regardless of which page it is 
   */ 
   if( $('.hotel-tabs .tabs-set .tabs').length ) {
    $(".tabs li:not(.book-now)").click(function() {
        if(! $(this).hasClass("active")) {
        var tabClasses = $(this).attr("class").split(/\s+/); 
        var tabClass = tabClasses[0]; 
        var parentClass = "." + $(this).parents(".hotel-tabs").attr("class").replace(/\s/g, ".");
        $(parentClass + " .tabs-set div.tab").hide(); 
        $(parentClass + " .tabs-set ." + tabClass + "-tab").show();
        $(parentClass + " .tabs li").removeClass("active"); 
        $(parentClass + " .tabs li." + tabClass).addClass("active"); 
        if( $(parentClass + " .image-tab").length ) {
          $(parentClass + " .image-tab").hide(); 
          $(parentClass + " .image-" + tabClass ).show();
          $(parentClass + " .image-tab").removeClass("active"); 
          $(parentClass + " .image-" + tabClass ).addClass("active"); 
        }
      }
    }); 
    if($('body.dining-weekend .hotel-tabs .tab').length) {
      $('.hotel-tabs .tab').each( function () {
        var additionalHeight = 39;
        if($(this).has('.videoWrapper')) { additionalHeight += 300; }
        if($(this).hasClass('gallery-tab') && $(this).parents('.tablet-3')) { additionalHeight += 200; }
        if($(this).hasClass('location-tab') && $(this).parents('.tablet-2')) { additionalHeight += 1100; }
        if($(this).hasClass('amenities-tab') && $(this).parents('.tablet-4')) { additionalHeight += 900; }
        if($(this).hasClass('amenities-tab') && $(this).parents('.tablet-5')) { additionalHeight += 240; }
        if($(this).height() > 400 ) {
          var oHeight = $(this).outerHeight(true) + additionalHeight;
          $(this).height(400); 
          $(this).css('overflow', 'hidden'); 
          $(this).append('<a href="#" class="read-more expand-tab" data-height="' + oHeight +'">Read More</a>'); 
        }
      });
    } 
    $('body.dining-weekend .hotel-tabs .tab a.expand-tab').click( function (event) {
      event.preventDefault(); 
      if($(this).text() == "Read More") {
        $(this).parents('.tab').animate({ height: $(this).data('height')}, 1000);
        $(this).text("Read Less"); 
      } else {
        $(this).parents('.tab').animate({ height: 400}, 1000);
        $(this).text("Read More"); 
      }
    });
   }

   if($('body:not(.dining-weekend) .hotels-tab .tab')) {
      var desiredHeight = 300; 
   // $('.hotel-tabs .tab').each( function() {
   //     var oHeight = $(this).height() + 37;
   //       $(this).height(desiredHeight); 
   //       $(this).css('overflow', 'hidden'); 
   //     if (oHeight > desiredHeight) {
   //       $(this).append('<a href="#" class="read-more-v2 expand-tab" data-height="' + oHeight +'">Read More</a>'); 
    //    }
    //  });

    $('.hotel-tabs .tab a.read-more-v2').click( function (event) {
      event.preventDefault();
      if($(this).text() == "Read More") {
        $(this).parents('.tab').animate({ height: $(this).data('height')}, 1000);
        $(this).text("Read Less"); 
        $(this).css({ background: " #fff url('/wp-content/themes/phg-gold/library/images/up-arrow.png') no-repeat 107px" });
      } else {
        $(this).parents('.tab').animate({ height: desiredHeight}, 1000);
        $(this).text("Read More"); 
        $(this).css({ background: " #fff url('/wp-content/themes/phg-gold/library/images/down-arrow.png') no-repeat 123px" });
      }
    });
   }

   if( $('.fullwidth-tabs .tabs-set .tabs').length ) {
    $(".tabs li:not(.book-now)").click(function() {
        if(! $(this).hasClass("active")) {
        var tabClasses = $(this).attr("class").split(/\s+/); 
        var tabClass = tabClasses[0]; 
        var parentClass = "." + $(this).parents(".fullwidth-tabs").attr("class").replace(/\s/g, ".");
        $(parentClass + " .tabs-set div.tab").hide(); 
        $(parentClass + " .tabs-set ." + tabClass + "-tab").show();
        $(parentClass + " .tabs li").removeClass("active"); 
        $(parentClass + " .tabs li." + tabClass).addClass("active"); 
        if( $(parentClass + " .image-tab").length ) {
          $(parentClass + " .image-tab").hide(); 
          $(parentClass + " .image-" + tabClass ).show();
          $(parentClass + " .image-tab").removeClass("active"); 
          $(parentClass + " .image-" + tabClass ).addClass("active"); 
        }
      }
    }); 
   }

   if( $('.hotel-tabs .gallery-tab .gallery-list').length ) {
    $('.hotel-tabs .gallery-tab .gallery-list li a').click(function(event) {
      event.preventDefault();
      var parentClass = "." + $(this).parents(".hotel-tabs").attr("class").replace(/\s/g, ".");
      $(parentClass + " > img").attr('src', $(this).attr('href'));
    });
   }

   if($('form.privacy-policy-form').length) {
      $('form.privacy-policy-form input[name="input_1.1"]').click(function() { $("form.privacy-policy-form").submit(); });
    }

   if( $('body.newsletter-response').length ) {
    var responseTxt = window.location.search.substring(1);
    var responseArr = responseTxt.match(/Success\:\%20Subscriber%20Added/g);
    if(responseArr.length) { $("#content .main-column .response").text("You have been successfully added to the newsletter subscription list.")}
   }

  $('footer .footer_nav_responsive li.footer-accordion ul li a').each( function() {
    var content = $(this).text(); 
    if($('nav ul.footer-nav a:contains("' + content + '")').length) {
      $(this).attr('href', $('nav ul.footer-nav a:contains("' + content + '")').attr('href'));
    } else if(content != "Directions") {
      $(this).hide(); 
    }
  });
  $('footer .footer_nav_responsive h3').click( function(event) { 
    event.preventDefault(); 
    $(this).parent().find('ul.footer_nav').slideToggle('fast'); 
  });

   /* Supporting 3rd Party Stuff */
  $('#NavisPhoneNumber').text(FormatPhone(NavisConvertTagToPhoneNumberBasic(ReadNavisTagCookie()), "###.###.####"));
  $('.NavisPhoneNumber').text(FormatPhone(NavisConvertTagToPhoneNumberBasic(ReadNavisTagCookie()), "###.###.####"));

}); /* end of as page load scripts */
