<?php

/**
 * Social Navigation Menu 
 */

/**
 * Register Social Icon menu
 */
add_action( 'init', 'register_social_menu' );

function register_social_menu() {
	register_nav_menu( 'social-menu', _x( 'Social Menu', 'nav menu location', 'phg_gold' ) );
}

if ( ! function_exists( 'phg_gold__social_icons' ) ) :
/**
 * Display social links in footer and widgets
 *
 * @package phg_gold
 */
function phg_gold_social_icons(){
  if ( has_nav_menu( 'social-menu' ) ) {
    if (has_tag('location')) {
        if(has_tag('bacara')) { $_menu_name = "Bacara Social Menu"; }
        elseif(has_tag('balboa')) { $_menu_name = "Balboa Social Menu"; }
        elseif(has_tag('estancia')) { $_menu_name = "Estancia Social Menu"; }
        elseif(has_tag('koakea')) { $_menu_name = "Koa Kea Social Menu"; }
        elseif(has_tag('meritage')) { $_menu_name = "Meritage Social Menu"; }
        elseif(has_tag('pasea')) { $_menu_name = "Pasea Social Menu"; }
        else { $_menu_name = "Social Menu"; }
        wp_nav_menu(array(
                'theme_location'  => 'social-menu',
                'container'       => 'nav',
                'menu' => $_menu_name,   // nav name
                'container_id'    => 'social',
                'container_class' => 'social-icons',
                'menu_id'         => 'menu-social-items',
                'menu_class'      => 'social-menu',
                'depth'           => 1,
                'fallback_cb'     => '',
                            'link_before'     => '<i class="social_icon fa"><span>',
                            'link_after'      => '</span></i>'
            ));
    } else {
      	wp_nav_menu(
      		array(
      			'theme_location'  => 'social-menu',
      			'container'       => 'nav',
      			'container_id'    => 'social',
      			'container_class' => 'social-icons',
      			'menu_id'         => 'menu-social-items',
      			'menu_class'      => 'social-menu',
      			'depth'           => 1,
      			'fallback_cb'     => '',
                            'link_before'     => '<i class="social_icon fa"><span>',
                            'link_after'      => '</span></i>'
      		)
    	  );
      }
  }
}
endif;

/* PHG Base Social Nav CSS */
function phg_gold_social_css(){ ?>
    <style type="text/css">
        #social li{
            display: inline-block;
        }
        #social li,
        #social ul {
            border: 0!important;
            list-style: none;
            padding-left: 0;
            text-align: center;
        }
        #social li a[href*="twitter.com"] .fa:before,
        .fa-twitter:before {
            content: "\f099"
        }
        #social li a[href*="facebook.com"] .fa:before,
        .fa-facebook-f:before,
        .fa-facebook:before {
            content: "\f09a"
        }
        #social li a[href*="github.com"] .fa:before,
        .fa-github:before {
            content: "\f09b"
        }
        #social li a[href*="/feed"] .fa:before,
        .fa-rss:before {
            content: "\f09e"
        }
        #social li a[href*="pinterest.com"] .fa:before,
        .fa-pinterest:before {
            content: "\f0d2"
        }
        #social li a[href*="plus.google.com"] .fa:before,
        .fa-google-plus:before {
            content: "\f0d5"
        }
        #social li a[href*="linkedin.com"] .fa:before,
        .fa-linkedin:before {
            content: "\f0e1"
        }
        #social li a[href*="youtube.com"] .fa:before,
        .fa-youtube:before {
            content: "\f167"
        }
        #social li a[href*="instagram.com"] .fa:before,
        .fa-instagram:before {
            content: "\f16d"
        }
        #social li a[href*="flickr.com"] .fa:before,
        .fa-flickr:before {
            content: "\f16e"
        }
        #social li a[href*="tumblr.com"] .fa:before,
        .fa-tumblr:before {
            content: "\f173"
        }
        #social li a[href*="dribbble.com"] .fa:before,
        .fa-dribbble:before {
            content: "\f17d"
        }
        #social li a[href*="skype.com"] .fa:before,
        .fa-skype:before {
            content: "\f17e"
        }
        #social li a[href*="foursquare.com"] .fa:before,
        .fa-foursquare:before {
            content: "\f180"
        }
        #social li a[href*="vimeo.com"] .fa:before,
        .fa-vimeo-square:before {
            content: "\f194"
        }
        #social li a[href*="spotify.com"] .fa:before,
        .fa-spotify:before {
            content: "\f1bc"
        }
        #social li a[href*="soundcloud.com"] .fa:before,
        .fa-soundcloud:before {
            content: "\f1be"
        }
    </style><?php
}
add_action( 'wp_head', 'phg_gold_social_css', 10 );