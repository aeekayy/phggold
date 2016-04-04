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
  }
}

function custom_filter_menu_hotel_name($args) {
  if(! is_admin() ) {
    $tags = get_the_tags();
    $tag_list = array(); 
    if(count($tags) > 0) {
      foreach($tags as $tag) {
        array_push($tag_list, $tag->name);
      }
    }
    $locations = array("brs", "tmr", "bbr", "kkr", "phs", "elj"); 
    $plugin_settings = get_option('dc_phgmgmtconsole');
    $curr_location = (count(array_intersect($tag_list, $locations)) > 0) ?  array_pop(array_intersect($tag_list, $locations)) : "default";
    $menu_name = $plugin_settings[$curr_location . '_base' ];
    return str_replace('__LOCATION__', $menu_name, $args);  
  }
}
// add_filter( 'wp_nav_menu', 'custom_filter_menu_hotel_name' );
endif;
