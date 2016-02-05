<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="inner-header" class="wrap cf">
					<?php
					$show_logo = true;
					$show_title = false;
					$show_tagline = true;
					$logo = get_theme_mod('header_logo', '');
					$tagline = ( get_bloginfo( 'description' ) ) ? get_bloginfo( 'description' ) : '';
					$header_show = get_theme_mod('header_show', 'logo-text');
					
					if( $header_show == 'logo-only' ){
						$show_tagline = false;
					}
					elseif( $header_show == 'title-only' ){
						$show_tagline = $show_logo = false;
					}
					elseif( $header_show == 'title-text' ){
						$show_logo = false;
						$show_title = true;
					}?>

					<div class="container">
						<div id="logo">
							<span class="site-name"><a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php 
								if( $show_logo && $logo ) { 
			                                            echo wp_get_attachment_image($logo, 'full');
								}
								elseif( $show_title ) { 
									bloginfo( 'name' );
								}
								else{
									bloginfo( 'name' );
								} ?>
								</a>
							</span><!-- end of .site-name -->
							
							<?php if( $show_tagline && get_bloginfo( 'description' ) != "" ) : ?>
								<div class="tagline"><?php bloginfo( 'description' ); ?></div>
							<?php endif; ?>
						</div><!-- end of #logo -->
						
						<?php if( ! is_front_page() || ! is_home() ) : ?>
						<div id="line"></div>
						<?php endif; ?>
						<div id="right-header" class="header-extras">
						<?php if( get_theme_mod('phg_gold_header_login') ) : ?>
						<span class="discovery login"><a class="login-link" href="/login">
						Discovery Login
						</a></span>
						<?php endif; ?>
						<?php if( get_theme_mod('phg_gold_header_book_now') ) : ?>
						<span class="book-now">
							<a class="book-link" href="/booking"><span class="link-text">Book Now</span></a>
						</span>
						<?php endif; ?>
					</div>

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>


					<nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
    					         'menu_class' => 'nav top-nav cf',               // adding custom nav class
    					         'theme_location' => 'main-nav',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 0,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>

					</nav>

				</div>

			</header>