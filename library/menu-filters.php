<?php
	add_filter( 'nav_menu_link_attributes', 'phg_featherlight_menu_attrs', 10, 3 );

	function phg_featherlight_menu_attrs( $atts, $item, $args )
	{
		$menu_target = 1965; 

		if ($item->ID == $menu_target) {
			$atts['data-featherlight'] = '#newsletter_signup'; 
			$atts['data-featherlight-variant'] = 'fixwidth'; 
		}
		return $atts;
	}