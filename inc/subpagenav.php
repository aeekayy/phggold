<?php

/**
 * Social Navigation Menu 
 */

/**
 * Register Social Icon menu
 */
add_action( 'init', 'register_fp_submenu_menu' );

function register_fp_submenu_menu() {
	register_nav_menu( 'fp-submenu-menu', _x( 'Sub-Page Gallery Menu', 'nav menu location', 'phg_gold' ) );
}

if ( ! function_exists( 'phg_gold_fp_submenu_display' ) ) :
/**
 * Display social links in footer and widgets
 *
 * @package phg_gold
 */
function phg_gold_fp_submenu_display(){
  if ( has_nav_menu( 'fp-submenu-menu' ) ) {
  	wp_nav_menu(
  		array(
  			'theme_location'  => 'fp-submenu-menu',
  			'container'       => 'nav',
  			'container_id'    => 'fp-submenu',
  			'container_class' => 'fp-submenu-icons cf',
  			'menu_id'         => 'menu-fp-submenu-items',
  			'menu_class'      => 'fp-submenu-menu',
  			'depth'           => 1,
  			'fallback_cb'     => '',
                        'link_before'     => '<span>',
                        'link_after'      => '</span>'
  		)
	  );

    foreach ( get_post_ancestors( $post->ID ) as $ancestorid ) 
    {
      //echo $ancestorid; 
    }
  }
}
endif;
