<?php

/**
 * Social Navigation Menu 
 */

/**
 * Register Social Icon menu
 */
add_action( 'init', 'register_fp_gallery_menu' );

function register_fp_gallery_menu() {
	register_nav_menu( 'fp-gallery-menu', _x( 'Front Page Gallery Menu', 'nav menu location', 'phg_gold' ) );
}

if ( ! function_exists( 'phg_gold_fp_gallery_icons' ) ) :
/**
 * Display social links in footer and widgets
 *
 * @package phg_gold
 */
function phg_gold_fp_gallery_icons(){
  if ( has_nav_menu( 'fp-gallery-menu' ) ) {
  	wp_nav_menu(
  		array(
  			'theme_location'  => 'fp-gallery-menu',
  			'container'       => 'nav',
  			'container_id'    => 'fp-gallery',
  			'container_class' => 'fp-gallery-icons',
  			'menu_id'         => 'menu-fp-gallery-items',
  			'menu_class'      => 'fp-gallery-menu',
  			'depth'           => 1,
  			'fallback_cb'     => '',
                        'link_before'     => '<span>',
                        'link_after'      => '</span>'
  		)
	  );
  }
}
endif;
