<?php
/**
 * phg_gold Theme Customizer
 *
 * @package phg_gold
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function phg_gold_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'phg_gold_customize_register' );

/**
 * Options for WordPress Theme Customizer.
 */
function phg_gold_customizer( $wp_customize ) {

  // logo
  $wp_customize->add_setting( 'header_logo', array(
    'default' => '',
    'transport'   => 'refresh',
                'sanitize_callback' => 'phg_gold_sanitize_number'
  ) );
        $wp_customize->add_control(new WP_Customize_Media_Control( $wp_customize, 'header_logo', array(
        'label' => __( 'Logo', 'phg_gold' ),
        'section' => 'title_tagline',
        'mime_type' => 'image',
        'priority'  => 10,
      ) ) );
      
      
    global $header_show;
    $wp_customize->add_setting('header_show', array(
            'default' => 'logo-text',
            'sanitize_callback' => 'phg_gold_sanitize_radio_header'
        ));    
        $wp_customize->add_control('header_show', array(
            'type' => 'radio',
            'label' => __('Show', 'phg_gold'),
            'section' => 'title_tagline',
            'choices' => $header_show
        ));
        
        /* Main option Settings Panel */
    $wp_customize->add_panel('phg_gold_main_options', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('PHG Base Options', 'phg_gold'),
        'description' => __('Panel to update phg_gold theme options', 'phg_gold'), // Include html tags such as <p>.
        'priority' => 10 // Mixed with top-level-section hierarchy.
    ));

  // add "Content Options" section
  $wp_customize->add_section( 'phg_gold_content_section' , array(
    'title'      => esc_html__( 'Content Options', 'phg_gold' ),
    'priority'   => 50,
                'panel' => 'phg_gold_main_options'
  ) );

  // add setting for excerpts/full posts toggle
  $wp_customize->add_setting( 'phg_gold_excerpts', array(
    'default'           => 1,
    'sanitize_callback' => 'phg_gold_sanitize_checkbox',
  ) );

  // add checkbox control for excerpts/full posts toggle
  $wp_customize->add_control( 'phg_gold_excerpts', array(
    'label'     => esc_html__( 'Show post excerpts?', 'phg_gold' ),
    'section'   => 'phg_gold_content_section',
    'priority'  => 10,
    'type'      => 'checkbox'
  ) );

  $wp_customize->add_setting( 'phg_gold_page_comments', array(
    'default' => 1,
    'sanitize_callback' => 'phg_gold_sanitize_checkbox',
  ) );

  $wp_customize->add_control( 'phg_gold_page_comments', array(
    'label'   => esc_html__( 'Display Comments on Static Pages?', 'phg_gold' ),
    'section' => 'phg_gold_content_section',
    'priority'  => 20,
    'type'      => 'checkbox',
  ) );
  
  
  // add "Featured Posts" section
  $wp_customize->add_section( 'phg_gold_featured_section' , array(
    'title'      => esc_html__( 'Slider Option', 'phg_gold' ),
    'priority'   => 60,
                'panel' => 'phg_gold_main_options'
  ) );  
  
  $wp_customize->add_setting( 'phg_gold_featured_cat', array(
    'default' => 0,
    'transport'   => 'refresh',
                'sanitize_callback' => 'phg_gold_sanitize_slidecat'
  ) );  
  
  $wp_customize->add_control( 'phg_gold_featured_cat', array(
    'type' => 'select',
    'label' => 'Choose a category',
    'choices' => phg_gold_cats(),
    'section' => 'phg_gold_featured_section',
  ) );
  
  $wp_customize->add_setting( 'phg_gold_featured_hide', array(
    'default' => 0,
    'transport'   => 'refresh',
                'sanitize_callback' => 'phg_gold_sanitize_checkbox'
  ) );  
  
  $wp_customize->add_control( 'phg_gold_featured_hide', array(
    'type' => 'checkbox',
    'label' => 'Show Slider',
    'section' => 'phg_gold_featured_section',
  ) );  
  
  // add Header Extras section
  $wp_customize->add_section( 'phg_gold_header_extra_section' , array(
    'title'      => esc_html__( 'Header Options', 'phg_gold' ),
    'priority'   => 60,
                'panel' => 'phg_gold_main_options'
  ) ); 
  
  $wp_customize->add_setting( 'phg_gold_header_login', array(
  	'default' => 0, 
  	'transport'	=> 'refresh', 
  		'sanitize_callback' => 'phg_gold_sanitize_checkbox'
  ) ); 
  
  $wp_customize->add_control( 'phg_gold_header_login', array(
  	'type' => 'checkbox', 
  	'label' => 'Show Header Login', 
  	'section' => 'phg_gold_header_extra_section', 
  ) ); 
  
  $wp_customize->add_setting( 'phg_gold_header_book_now', array(
  	'default' => 0, 
  	'transport'	=> 'refresh', 
  		'sanitize_callback' => 'phg_gold_sanitize_checkbox'
  ) ); 
  
  $wp_customize->add_control( 'phg_gold_header_book_now', array(
  	'type' => 'checkbox', 
  	'label' => 'Show Book Now', 
  	'section' => 'phg_gold_header_extra_section', 
  ) ); 
  
  // add "Sidebar" section
        $wp_customize->add_section('phg_gold_layout_section', array(
            'title' => __('Layout options', 'phg_gold'),
            'description' => sprintf(__('', 'phg_gold')),
            'priority' => 31,
            'panel' => 'phg_gold_main_options'
        ));
            // Layout options
            global $site_layout;
            $wp_customize->add_setting('phg_gold_sidebar_position', array(
                 'default' => 'side-right',
                 'sanitize_callback' => 'phg_gold_sanitize_layout'
            ));
            $wp_customize->add_control('phg_gold_sidebar_position', array(
                 'label' => __('Website Layout Options', 'phg_gold'),
                 'section' => 'phg_gold_layout_section',
                 'type'    => 'select',
                 'description' => __('Choose between different layout options to be used as default', 'phg_gold'),
                 'choices'    => $site_layout
            )); 
  
            $wp_customize->add_setting('accent_color', array(
                    'default' => '',
                    'sanitize_callback' => 'phg_gold_sanitize_hexcolor'
                ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
                'label' => __('Accent Color', 'phg_gold'),
                'description'   => __('Default used if no color is selected','phg_gold'),
                'section' => 'phg_gold_layout_section',
            )));
            
            $wp_customize->add_setting('social_color', array(
                'default' => '',
                'sanitize_callback' => 'phg_gold_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'social_color', array(
                'label' => __('Social icon color', 'phg_gold'),
                'description' => sprintf(__('Default used if no color is selected', 'phg_gold')),
                'section' => 'phg_gold_layout_section',
            )));

            $wp_customize->add_setting('social_hover_color', array(
                'default' => '',
                'sanitize_callback' => 'phg_gold_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'social_hover_color', array(
                'label' => __('Social Icon:hover Color', 'phg_gold'),
                'description' => sprintf(__('Default used if no color is selected', 'phg_gold')),
                'section' => 'phg_gold_layout_section',
            )));
  
  // add "Footer" section
  $wp_customize->add_section( 'phg_gold_footer_section' , array(
    'title'      => esc_html__( 'Footer', 'phg_gold' ),
    'priority'   => 90,
  ) );  
  
  $wp_customize->add_setting( 'phg_gold_footer_copyright', array(
    'default' => '',
    'transport'   => 'refresh',
                'sanitize_callback' => 'phg_gold_sanitize_strip_slashes'
  ) );

  $wp_customize->add_control( 'phg_gold_footer_copyright', array(
    'type' => 'textarea',
    'label' => 'Copyright Text',
    'section' => 'phg_gold_footer_section',
  ) );
        
        /* PHG Base Other Options */
        $wp_customize->add_section('phg_gold_other_options', array(
            'title' => __('Other', 'phg_gold'),
            'priority' => 70,
            'panel' => 'phg_gold_main_options'
        ));
            $wp_customize->add_setting('custom_css', array(
                'default' => '',
                'sanitize_callback' => 'phg_gold_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('custom_css', array(
                'label' => __('Custom CSS', 'phg_gold'),
                'description' => sprintf(__('Additional CSS', 'phg_gold')),
                'section' => 'phg_gold_other_options',
                'type' => 'textarea'
            ));
            
}
add_action( 'customize_register', 'phg_gold_customizer' );

/**
 * Adds sanitization callback function: Strip Slashes
 * @package phg_gold
 */
function phg_gold_sanitize_strip_slashes($input) {
    return wp_kses_stripslashes($input);
}

/**
 * Sanitzie checkbox for WordPress customizer
 */
function phg_gold_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Adds sanitization callback function: Sidebar Layout
 * @package phg_gold
 */
function phg_gold_sanitize_layout( $input ) {
    global $site_layout;
    if ( array_key_exists( $input, $site_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: colors
 * @package phg_gold
 */
function phg_gold_sanitize_hexcolor($color) {
    if ($unhashed = sanitize_hex_color_no_hash($color))
        return '#' . $unhashed;
    return $color;
}

/**
 * Adds sanitization callback function: Slider Category
 * @package phg_gold
 */
function phg_gold_sanitize_slidecat( $input ) {
    
    if ( array_key_exists( $input, phg_gold_cats()) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Radio Header
 * @package phg_gold
 */
function phg_gold_sanitize_radio_header( $input ) {
   global $header_show;
    if ( array_key_exists( $input, $header_show ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Number
 * @package phg_gold
 */
function phg_gold_sanitize_number($input) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function phg_gold_customize_preview_js() {
  wp_enqueue_script( 'phg_gold_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20140317', true );
}
add_action( 'customize_preview_init', 'phg_gold_customize_preview_js' );

/**
 * Add CSS for custom controls
 */
function phg_gold_customizer_custom_control_css() {
  ?>
    <style>
        #customize-control-phg_gold-main_body_typography-size select, #customize-control-phg_gold-main_body_typography-face select,#customize-control-phg_gold-main_body_typography-style select { width: 60%; }
    </style><?php
}
add_action( 'customize_controls_print_styles', 'phg_gold_customizer_custom_control_css' );

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'customizer_custom_scripts' );