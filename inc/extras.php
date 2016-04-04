<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package phg_gold
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function phg_gold_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'phg_gold_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function phg_gold_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  if ( !is_home() && !is_front_page() ) {
    $classes[] = 'subpage'; 
  }
	
	if ( get_theme_mod( 'phg_gold_sidebar_position' ) == "pull-right" ) {
		$classes[] = 'has-sidebar-left';
	} else if ( get_theme_mod( 'phg_gold_sidebar_position' ) == "no-sidebar" ) {
		$classes[] = 'has-no-sidebar';
	} else if ( get_theme_mod( 'phg_gold_sidebar_position' ) == "full-width" ) {
		$classes[] = 'has-full-width';
	} else {
		$classes[] = 'has-sidebar-right';
	}

  return $classes;
}
add_filter( 'body_class', 'phg_gold_body_classes' );


// Mark Posts/Pages as Untiled when no title is used
add_filter( 'the_title', 'phg_gold_title' );

function phg_gold_title( $title ) {
  if ( $title == '' ) {
    return 'Untitled';
  } else {
    return $title;
  }
}

/**
 * Password protected post form using Boostrap classes
 */
add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
  global $post;
  $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
  $o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
  <div class="row">
    <div class="col-lg-10">
        ' . esc_html__( "<p>This post is password protected. To view it please enter your password below:</p>" ,'phg_gold') . '
        <label for="' . $label . '">' . esc_html__( "Password:" ,'phg_gold') . ' </label>
      <div class="input-group">
        <input class="form-control" value="' . get_search_query() . '" name="post_password" id="' . $label . '" type="password">
        <span class="input-group-btn"><button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="' . esc_attr__( "Submit",'phg_gold' ) . '">' . esc_html__( "Submit" ,'phg_gold') . '</button>
        </span>
      </div>
    </div>
  </div>
</form>';
  return $o;
}

// Add Bootstrap classes for table
add_filter( 'the_content', 'phg_gold_add_custom_table_class' );
function phg_gold_add_custom_table_class( $content ) {
    return str_replace( '<table>', '<table class="table table-hover">', $content );
}

if ( ! function_exists( 'phg_gold_header_menu' ) ) :
/**
 * Header menu (should you choose to use one)
 */
function phg_gold_header_menu() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 2,
    'container'         => 'div',
    'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
    'menu_class'        => 'nav navbar-nav',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker()
  ));
} /* end header menu */
endif;

if ( ! function_exists( 'phg_gold_footer_links' ) ) :
/**
 * Footer menu (should you choose to use one)
 */
function phg_gold_footer_links() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'container'       => '',                              // remove nav container
    'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    'menu'            => esc_html__( 'Footer Links', 'phg_gold' ),   // nav name
    'menu_class'      => 'nav footer-nav clearfix',      // adding custom nav class
    'theme_location'  => 'footer-links',             // where it's located in the theme
    'before'          => '',                                 // before the menu
    'after'           => '',                                  // after the menu
    'link_before'     => '',                            // before each link
    'link_after'      => '',                             // after each link
    'depth'           => 0,                                   // limit the depth of the nav
    'fallback_cb'     => 'phg_gold_footer_links_fallback'  // fallback function
  ));
} /* end phg_gold footer link */
endif;

if ( ! function_exists( 'custom_filter_footer_social_name' ) ) :

function custom_filter_footer_social_name($args) {
  if(! is_admin() ) {
    $tags = get_the_tags();
    $tag_list = array(); 
    if(count($tags) > 0 && is_array($tags)) {
      foreach($tags as $tag) {
        array_push($tag_list, $tag->name);
      }
    }
    $locations = array("brs", "tmr", "bbr", "kkr", "phs", "elj"); 
    $plugin_settings = get_option('dc_phgmgmtconsole');
    $curr_location = (count(array_intersect($tag_list, $locations)) > 0) ?  array_pop(array_intersect($tag_list, $locations)) : "default";
    if ($curr_location == "default") {
      $menu_name = ''; 
    } else {
      $menu_name = $plugin_settings[$curr_location . '_base' ];
    }
    return str_replace('__LOCATION__', $menu_name, $args);  
  }
}
add_filter( 'wp_nav_menu', 'custom_filter_footer_social_name' );
endif;

if ( ! function_exists( 'phg_gold_featured_image' ) ) :
/**
 * Show the featured image 
 */
function phg_gold_featured_image() {
  if( ( !is_home() && !is_front_page() ) ) {
    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
      $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
      $featured_img_url = $featured_img['0'];
      echo '<section class="featured-image wp-post-image parallax-move" style="background-image:url(\' ' . $featured_img_url . ' \');"></section>';
      // the_post_thumbnail( 'full', array('class'=>"attachment-full parallax-move") );
      if ( sizeof(get_post_custom_values('location')) != 0 ) :
          $content = array_pop(get_post_custom_values('location'));
          $location_array = explode(',', htmlspecialchars($content)); 
          $city = $location_array[0];
          $location_html = '<div class="location-card">';
          if (strtolower($content) == "poipu beach, hi") {
            date_default_timezone_set('Pacific/Honolulu');
          } else {
            date_default_timezone_set('America/Los_Angeles');
          }
          $jsonurl = "http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($content) . '&APPID=ee2337a86981da09d339cc66337fcb7e';
          $json = file_get_contents($jsonurl);
          $weather = json_decode($json);
          $kelvin = $weather->main->temp;
          $celcius = $kelvin - 273.15;
          $fahrenheit = $celcius * 9/5 + 32; 
          
          $location_html .= '<h1 class="city-location">'.$city.'</h1>';
          $location_html .= '<span class="temperature-display">' . round($fahrenheit);
          $location_html .= '&degF</span><span class="time-display">' . date('g:i a'); 
          $location_html .= '</span></div>'; 
          echo $location_html; 
      endif;

      if(has_tag('location')) {
        phg_gold_get_hotel_menu();
      }
    } 
  }
}
endif; 

if ( ! function_exists( 'phg_gold_featured_product_image' ) ) :
/**
 * Show the featured image 
 */
function phg_gold_featured_product_image() {
  if( ( !is_home() && !is_front_page() ) ) {
    if ( sizeof(get_post_custom_values('featured_image')) != 0 ) {
      $featured_img = htmlspecialchars(array_pop(get_post_custom_values('featured_image')));
      echo '<section class="featured-image wp-post-image parallax-move" style="background-image:url(\' ' . $featured_img . ' \');"></section>';
      
      phg_gold_get_hotel_menu();
    } 
  }
}
endif; 

if ( ! function_exists( 'phg_gold_get_hotel_footer_menu' ) ):
function phg_gold_get_hotel_footer_menu() {
  if( has_tag('bacara') ) {
    $menu = wp_get_nav_menu_object( "Bacara Footer Menu" );
    $class = "bacara-footer-menu"; 
  } elseif( has_tag('balboa')) {
    $menu = wp_get_nav_menu_object( "Balboa Footer Menu" );
    $class = "balboa-footer-menu";
  }
  elseif ( has_tag('estancia') ) {
    $menu = wp_get_nav_menu_object( "Estancia Footer Menu" );
    $class = "estancia-footer-menu";
  }
  elseif ( has_tag('koakea') ) {
    $menu = wp_get_nav_menu_object( "Koa Kea Footer Menu" );
    $class = "koakea-footer-menu";
  }
  elseif ( has_tag('meritage') ) {
    $menu = wp_get_nav_menu_object( "Meritage Footer Menu" );
    $class = "meritage-footer-menu";
  }
  elseif ( has_tag('pasea') ) {
    $menu = wp_get_nav_menu_object( "Pasea Footer Menu" );
    $class = "pasea-footer-menu";
  }
  else {
    $menu = wp_get_nav_menu_object( "Footer Menu" );
    $class = "default-footer-menu";
  }
   $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
  print '<nav class="hotel-footer-menu '. $class . '" role="navigation">';
  print '<div class="footer-links cf">';
  print '<ul class="nav footer-nav-cf" id="menu-footer-menu">';
  $count = 0; 
  $submenu = false; 

  if (count($menuitems) > 0) {
    foreach( $menuitems as $item ):
      $title = $item->title; 
      $link = $item->url; 

      if ( !$item->menu_item_parent ):
        $parent_id = $item->ID;
        print "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-$parent_id' id='menu-item-$parent_id'>";
        print "<a href='$link' class='title'>$title</a>";
      endif;  

      if( $parent_id == $item->menu_item_parent ):
        if( !$submenu ): $submenu = true; 
          print "<ul class='sub-menu'>";
        endif;
        print "<li class='item'><a href='$link' class='title'>$title</a></li>";

        if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): 
          print "</ul>";
          $submenu = false; 
        endif;

        if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ):
          print "</li>";
          $submenu = false;
        endif;
      endif;
      $count++;
    endforeach;
  }
  print '</ul>';
  print '</div>'; 
  print '</nav>'; 
}
endif; 

if ( ! function_exists( 'phg_gold_get_hotel_menu' ) ):
function phg_gold_get_hotel_menu() {
  if( has_tag('bacara') ) {
    $menu = wp_get_nav_menu_object( "Bacara Menu" );
    $class = "bacara-menu"; 
    $img_logo = "/wp-content/themes/phg-gold/library/images/bacara-logo.png";
    $img_title = "Bacara Resort and Spa"; 
    $link = "/bacararesort/";
  }
  elseif ( has_tag('balboa') || has_tag('product_tag-balboa')) {
    $menu = wp_get_nav_menu_object( "Balboa Menu" );
    $class = "balboa-menu";
    $img_logo = "/wp-content/themes/phg-gold/library/images/balboa-logo.png";
    $img_title = "Balboa Bay Resort and Spa"; 
    $link = "/balboabayresort/"; 
  }
  elseif ( has_tag('estancia') ) {
    $menu = wp_get_nav_menu_object( "Estancia Menu" );
    $class = "estancia-menu";
    $img_logo = "/wp-content/themes/phg-gold/library/images/estancia-logo.png";
    $img_title = "Estancia La Jolla Hotel"; 
    $link = "/estancialajolla/";
  }
  elseif ( has_tag('koakea') ) {
    $menu = wp_get_nav_menu_object( "Koa Kea Menu" );
    $class = "koakea-menu";
    $img_logo = "/wp-content/themes/phg-gold/library/images/koakea-logo.png";
    $img_title = "Koa Kea Hotel";
    $link = "/koakea/"; 
  }
  elseif ( has_tag('meritage') ) {
    $menu = wp_get_nav_menu_object( "Meritage Menu" );
    $class = "meritage-menu";
    $img_logo = "/wp-content/themes/phg-gold/library/images/meritage-logo.png";
    $img_title = "The Meritage Resort and Spa"; 
    $link = "/meritageresort/";
  }
  elseif ( has_tag('pasea') ) {
    $menu = wp_get_nav_menu_object( "Pasea Menu" );
    $class = "pasea-menu";
    $img_logo = "/wp-content/themes/phg-gold/library/images/pasea-logo.png";
    $img_title = "Pasea Hotel and Spa";
    $link = "/paseahotel/"; 
  }
  else {
    $menu = wp_get_nav_menu_object( "Sub-Page Menu" );
    $class = "default-menu";
  }
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
  print '<nav class="hotel-submenu '. $class . ' fp-submenu-icons cf" id="fp-submenu">';
  print '<span id="hotel_nav-menu_button" class="icon-menu"></span>'; 
  $img_headers = @get_headers($img_logo); 
  if ( $img_logo && $img_headers[0] != 'HTTP/1.1 404 Not Found' ) { print "<a href='$link'><img class='hotel-logo' src='$img_logo' alt='$img_title'/></a>"; }
  print '<ul class="fp-submenu-menu" id="menu-fp-submenu-items">';
  $count = 0; 
  $submenu = false; 

  if (count($menuitems) > 0) {
    foreach( $menuitems as $item ):
      $title = $item->title; 
      $link = $item->url; 

      if ( !$item->menu_item_parent ):
        $parent_id = $item->ID;
        print "<li class='item'>";
        print "<a href='$link' class='title'>$title</a>";
      endif;  

      if( $parent_id == $item->menu_item_parent ):
        if( !$submenu ): $submenu = true; 
          print "<ul class='sub-menu'>";
        endif;
        print "<li class='item'><a href='$link' class='title'>$title</a></li>";

        if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): 
          print "</ul>";
          $submenu = false; 
        endif;

        if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ):
          print "</li>";
          $submenu = false;
        endif;
      endif;
      $count++;
    endforeach;
  }
  print '</ul>';
  print '</nav>'; 
}
endif;

if( ! function_exists( 'phg_gold_featured_video' ) ):
function phg_gold_featured_video() {
  $show_controls = '';
  //if(is_ipad() || is_phone()) { $show_controls=" controls"; }
  if ( sizeof(get_post_custom_values('featured_video')) != 0 ) :
    echo '<div class="featured-video">'; 
      echo '<video id="featuredVideo" width="1920" preload ' . $show_controls .' autoplay loop>';
      echo '<source src="' . htmlspecialchars(array_pop(get_post_custom_values('featured_video'))) . '" type="video/mp4">';
      echo '<source src="' . str_replace("mp4", "webm", htmlspecialchars(array_pop(get_post_custom_values('featured_video')))) . '" type="vp8,vorbis">'; 
      echo 'Your browser does not support the video element.'; 
      echo '</video>';
      echo '<div class="flex-caption">';
          if ( sizeof(get_post_custom_values('featured_title')) > 0) echo '<a href="' . get_permalink() . '"><h2 class="entry-title">'. array_pop(get_post_custom_values('featured_title')).'</h2></a>';
          //if ( get_the_title() != '' ) echo '<a href="' . get_permalink() . '"><h2 class="entry-title">'. get_the_title().'</h2></a>';
          if (get_post_meta($query->post->ID, 'tagline', true) != '') { $link_text = get_post_meta($query->post->ID, 'tagline', true); } else { $link_text = 'Read More'; }
          echo '<div class="read-more"><a href="' . get_permalink() . '">' . __( $link_text, 'phg_gold' ) .'</a></div>';
      echo '</div>';
    echo '</div>';
    echo '<script>document.getElementById("featuredVideo").width=document.body.offsetWidth;</script>'; 

    if( has_tag('location') ) {
      phg_gold_get_hotel_menu();
    }
  endif;
}
endif; 

if ( ! function_exists( 'phg_gold_featured_master_slider' ) ) :
/**
 * Featured image slider, displayed on front page for static page and blog
 */
function phg_gold_featured_master_slider() {
  if ( sizeof(get_post_custom_values('featured_slider')) != 0 ) :
    preg_match('!\d+!', array_pop(get_post_custom_values('featured_slider')), $matches);
    masterslider(array_pop($matches));

    if( has_tag('location') ) {
      phg_gold_get_hotel_menu(); 
    }
  endif;
}
endif;

if ( ! function_exists( 'phg_gold_featured_slider' ) ) :
/**
 * Featured image slider, displayed on front page for static page and blog
 */
function phg_gold_featured_slider() {
  if ( ( is_home() || is_front_page() ) && get_theme_mod( 'phg_gold_featured_hide' ) == 1 ) {
		wp_enqueue_style( 'flexslider-css' );
		wp_enqueue_script( 'flexslider-js' );
		
    echo '<div class="flexslider">';
      echo '<ul class="slides">';

        $count = 4;
        $slidecat = get_theme_mod( 'phg_gold_featured_cat' );

        $query = new WP_Query( array( 'post_type' => 'page', 'meta_key' => 'flexslide', 'meta_value' => null, 'meta_compare' => '!=', 'orderby' => 'meta_value_num', 'order' => 'DESC' ) );
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
          echo '<li>';
            $img_url = get_post_meta($query->post->ID, 'flexslide', true); 
            $img_headers = @get_headers($img_url); 
            if ( $img_url && $img_headers[0] != 'HTTP/1.1 404 Not Found' ) :
              list($img_width, $img_height, $img_type, $img_attr) = getimagesize($img_url); 
              echo '<img width="' . $img_width .'" height="' . $img_height . '" src="' . $img_url . '" class="attachment-phg_gold-slider wp-post-image" alt="' . get_the_title() .'" draggable="false"/>'; 
            else:
              $img_err = "/wp-content/phg-gold/library/images/error404.jpg"; 
              list($img_width, $img_height, $img_type, $img_attr) = getimagesize($img_err); 
              echo '<img width="' . $img_width .'" height="' . $img_height . '" src="' . $img_err . '" class="attachment-phg_gold-slider wp-post-image" alt="' . get_the_title() .'" draggable="false"/>';
            endif;

              echo '<div class="flex-caption">';
                  if ( get_the_title() != '' ) echo '<a href="' . get_permalink() . '"><h2 class="entry-title">'. get_the_title().'</h2></a>';
                  if (get_post_meta($query->post->ID, 'tagline', true) != '') { $link_text = get_post_meta($query->post->ID, 'tagline', true); } else { $link_text = 'Read More'; }
                  echo '<div class="read-more"><a href="' . get_permalink() . '">' . __( $link_text, 'phg_gold' ) .'</a></div>';
              echo '</div>';

              endwhile; wp_reset_query();
            endif;

          echo '</li>';
      echo '</ul>';
    echo ' </div>';
  } elseif( get_post_meta($post->ID, 'flexslides', TRUE) != '' ) {
    wp_enqueue_style( 'flexslider-css' );
    wp_enqueue_script( 'flexslider-js' );
    
    echo '<div class="flexslider">';
      echo '<ul class="slides">';
        
        $img_array = explode(",", get_post_meta($post->ID,'flexslides',TRUE)); 

        if (sizeof($img_array) > 0) :
          while( list($key, $val) = each($img_array) ) {
          echo '<li>';
            $img_url = $val; 
            $img_headers = @get_headers($img_url); 
            if ( $img_url && $img_headers[0] != 'HTTP/1.1 404 Not Found' ) :
              list($img_width, $img_height, $img_type, $img_attr) = getimagesize($img_url); 
              echo '<img width="' . $img_width .'" height="' . $img_height . '" src="' . $img_url . '" class="attachment-phg_gold-slider wp-post-image" alt="' . get_the_title() .'" draggable="false"/>'; 
            else:
              $img_err = "/wp-content/phg-gold/library/images/error404.jpg"; 
              list($img_width, $img_height, $img_type, $img_attr) = getimagesize($img_err); 
              echo '<img width="' . $img_width .'" height="' . $img_height . '" src="' . $img_err . '" class="attachment-phg_gold-slider wp-post-image" alt="' . get_the_title() .'" draggable="false"/>';
            endif;

              } 
              wp_reset_query();
            endif;

          echo '</li>';
      echo '</ul>';
    echo ' </div>';
  }
}
endif;

if ( ! function_exists( 'phg_newsletter_signup' ) ) :
  function phg_newsletter_signup() {
    echo '<div class="newsletter featherlight" id="newsletter_signup">';
    echo '<div class="inner-container">';
    echo '<form class="form-horizontal">';
    echo '<fieldset>';
    echo '<!-- Form Name -->';
    echo '<legend>Form Name</legend>';
    echo '<!-- Text input-->';
    echo '<div class="form-group">';
    echo '<label class="col-md-4 control-label" for="FirstName">FirstName</label>  ';
    echo '<div class="col-md-4">';
    echo '<input id="name" name="FirstName" type="text" placeholder="Please enter your first name here" class="form-control input-md" required="">';
    echo '</div>';
    echo '</div>';
    echo '<!-- Text input-->';
    echo '<div class="form-group">';
    echo '<label class="col-md-4 control-label" for="LastName">LastName</label>  ';
    echo '<div class="col-md-4">';
    echo '<input id="name" name="LastName" type="text" placeholder="Please enter your last name here" class="form-control input-md" required="">';
    echo '</div>';
    echo '</div>';
    echo '<!-- Text input-->';
    echo '<div class="form-group">';
    echo '<label class="col-md-4 control-label" for="email">Email Address</label>  ';
    echo '<div class="col-md-4">';
    echo '<input id="emailaddr" name="email" type="text" placeholder="Please enter your email address here" class="form-control input-md" required="">';                
    echo '</div>';
    echo '</div>';
    echo '<!-- Multiple Checkboxes -->';
    echo '<div class="form-group">';
    echo '<label class="col-md-4 control-label" for="customizeSelection"></label>';
    echo '<div class="col-md-4">';
    echo '<div class="checkbox">';
    echo '<label for="customizeSelection-0">';
    echo '<input type="checkbox" name="customizeSelection" id="customizeSelection-0" value="1">';
    echo 'Customize your subscription';
    echo '</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<!-- Button (Double) -->';
    echo '<div class="form-group">';
    echo '<label class="col-md-4 control-label" for="btnSubmit"></label>';
    echo '<div class="col-md-8">';
    echo '<button id="btnSubmit" name="btnSubmit" class="btn btn-success">Submit</button>';
    echo '<button id="btnCancel" name="btnCancel" class="btn btn-danger">Cancel</button>';
    echo '</div>';
    echo '</div>';
    echo '</fieldset>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
  }
endif;

if ( ! function_exists( 'phg_gold_social_stream' ) ) :
/**
 * Featured image slider, displayed on front page for static page and blog
 */
function phg_gold_social_stream() {
  if ( ( is_home() || is_front_page() ) ) {
		
    echo '<div class="phg-gold social-stream-wall">';
      $all_plugins = get_plugins();
      echo $all_plugins;
    echo ' </div>';
  }
}
endif;

/**
 * function to show the footer info, copyright information
 */
function phg_gold_footer_info() {
global $phg_gold_footer_info;
  printf( esc_html__( 'Theme by %1$s Powered by %2$s', 'phg_gold' ) , '<a href="http://colorlib.com/" target="_blank">Colorlib</a>', '<a href="http://wordpress.org/" target="_blank">WordPress</a>');
}


/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function phg_gold_caption($output, $attr, $content) {
  if (is_feed()) {
    return $output;
  }

  $defaults = array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => ''
  );

  $attr = shortcode_atts($defaults, $attr);

  // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
  if ($attr['width'] < 1 || empty($attr['caption'])) {
    return $content;
  }

  // Set up the attributes for the caption <figure>
  $attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
  $attributes .= ' style="width: ' . (esc_attr($attr['width']) + 10) . 'px"';

  $output  = '<figure' . $attributes .'>';
  $output .= do_shortcode($content);
  $output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
  $output .= '</figure>';

  return $output;
}
add_filter('img_caption_shortcode', 'phg_gold_caption', 10, 3);

function bones_get_the_author_posts_link() {
    global $authordata;
    if ( ! is_object( $authordata ) ) {
        return;
    }
 
    $link = sprintf(
        '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
        esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
        esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ),
        get_the_author()
    );
 
    /**
     * Filter the link to the author page of the author of the current post.
     *
     * @since 2.9.0
     *
     * @param string $link HTML link.
     */
    return apply_filters( 'the_author_posts_link', $link );
}

/**
 * Skype URI support for social media icons
 */
function phg_gold_allow_skype_protocol( $protocols ){
    $protocols[] = 'skype';
    return $protocols;
}
add_filter( 'kses_allowed_protocols' , 'phg_gold_allow_skype_protocol' );

/**
 * Add custom favicon displayed in WordPress dashboard and frontend
 */
function phg_gold_add_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_template_directory_uri() . '/favicon.png" />'. "\n";
}
add_action( 'wp_head', 'phg_gold_add_favicon', 0 );
add_action( 'admin_head', 'phg_gold_add_favicon', 0 );


/*
 * This display blog description from wp customizer setting.
 */
function phg_gold_cats() {
	$cats = array();
	$cats[0] = "All";
	
	foreach ( get_categories() as $categories => $category ) {
		$cats[$category->term_id] = $category->name;
	}

	return $cats;
}

/**
 * Custom comment template
 */
function phg_gold_cb_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	 <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

	<div class="comment-author vcard">
  	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
  	<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'phg_gold' ), get_comment_author_link() ); ?>
  	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
      <?php
        /* translators: 1: date, 2: time */
        sprintf( __( '%1$s at %2$s', 'phg_gold' ), get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( __( 'Edit', 'phg_gold' ), '  ', '' );
      ?>
    </div>

  </div>

	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'phg_gold' ); ?></em>
		<br />
	<?php endif; ?>

	<?php comment_text(); ?>

	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/**
 * Get custom CSS from Theme setting panel and output in header
 */
if (!function_exists('get_phg_gold_theme_setting'))  {
  function get_phg_gold_theme_setting(){

    echo '<style type="text/css">';

    if ( get_theme_mod('accent_color')) {
      echo 'a:hover, a:focus,article.post .post-categories a:hover,
          .entry-title a:hover, .entry-meta a:hover, .entry-footer a:hover,
          .read-more a:hover, .social-icons a:hover,
          .flex-caption .post-categories a:hover, .flex-caption .read-more a:hover,
          .flex-caption h2:hover, .comment-meta.commentmetadata a:hover,
          .post-inner-content .cat-item a:hover,.navbar-default .navbar-nav > .active > a,
          .navbar-default .navbar-nav > .active > a:hover,
          .navbar-default .navbar-nav > .active > a:focus,
          .navbar-default .navbar-nav > li > a:hover,
          .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > .open > a,
          .navbar-default .navbar-nav > .open > a:hover, blockquote:before,
          .navbar-default .navbar-nav > .open > a:focus, .cat-title a,
          .single .entry-content a, .site-info a:hover {color:' . get_theme_mod('accent_color') . '}';

      echo 'article.post .post-categories:after, .post-inner-content .cat-item:after, #secondary .widget-title:after {background:' . get_theme_mod('accent_color') . '}';

      echo '.btn-default:hover, .label-default[href]:hover,
          .label-default[href]:focus, .btn-default:hover,
          .btn-default:focus, .btn-default:active,
          .btn-default.active, #image-navigation .nav-previous a:hover,
          #image-navigation .nav-next a:hover, .woocommerce #respond input#submit:hover,
          .woocommerce a.button:hover, .woocommerce button.button:hover,
          .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover,
          .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover,
          .woocommerce input.button.alt:hover, .input-group-btn:last-child>.btn:hover, .scroll-to-top:hover,
          button, html input[type=button]:hover, input[type=reset]:hover, .comment-list li .comment-body:after, .page-links a:hover span, .page-links span,
          input[type=submit]:hover, .comment-form #submit:hover, .tagcloud a:hover,
          .single .entry-content a:hover, .dropdown-menu > li > a:hover, 
          .dropdown-menu > li > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
          .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus{background-color:' . get_theme_mod('accent_color') . '; }';
    }
    if ( get_theme_mod('social_color')) {
      echo '#social a, .header-search-icon { color:' . get_theme_mod('social_color') .'}';
    }
    if ( get_theme_mod('social_hover_color')) {
      echo '#social a:hover, .header-search-icon:hover { color:' . get_theme_mod('social_hover_color') .'}';
    }

    if ( get_theme_mod('custom_css')) {
      echo html_entity_decode( get_theme_mod( 'custom_css', 'no entry' ) );
    }

    echo '</style>';
  }
}
add_action('wp_head','get_phg_gold_theme_setting',10);