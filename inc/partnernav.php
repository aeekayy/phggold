<?php

/**
 * Partner Icon Navigation Menu 
 */

/**
 * Register Partner Icon menu
 */
add_action( 'init', 'register_partner_menu' );

function register_partner_menu() {
	register_nav_menu( 'partner-menu', _x( 'Partner Menu', 'nav menu location', 'phg_gold' ) );
}

if ( ! function_exists( 'phg_gold_partner_icons' ) ) :
/**
 * Display partner links in footer and widgets
 *
 * @package phg_gold
 */
function phg_gold_partner_icons(){
  if ( has_nav_menu( 'partner-menu' ) ) {
    if(has_tag('bacara')) { $_menu_name = "Bacara Partners Menu"; }
    else { $_menu_name = "Partners Menu"; }
  	wp_nav_menu(
  		array(
  			'theme_location'  => 'partner-menu',
  			'container'       => 'nav',
        'menu' => $_menu_name,   // nav name
  			'container_id'    => 'partner',
  			'container_class' => 'partner-icons',
  			'menu_id'         => 'menu-partner-items',
  			'menu_class'      => 'partner-menu',
  			'depth'           => 1,
  			'fallback_cb'     => '',
                        'link_before'     => '<i class="partner_icon page-item-'.$ID.'"><span>',
                        'link_after'      => '</span></i>'
  		)
	  );
  }
}
endif;

/* PHG Base Partner Nav CSS */
function phg_gold_partner_css(){ ?>
    <style type="text/css">
        #partner li{
            display: inline-block;
        }
        #partner li,
        #partner ul {
            border: 0!important;
            list-style: none;
            padding-left: 0;
            text-align: center;
        }
    </style><?php
}
add_action( 'wp_head', 'phg_gold_partner_css', 10 );