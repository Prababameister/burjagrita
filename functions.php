<?php
function burjagrita_css_scripts () {
    wp_enqueue_style('header_styles', get_template_directory_uri() . '/assets/css/header_styles.css', false, '1.1', 'all');
    wp_enqueue_style('home_styles', get_template_directory_uri() . '/assets/css/home_styles.css', false, '1.1', 'all');
}
add_action('wp_enqueue_scripts', 'burjagrita_css_scripts');

function burjagrita_post_init() {
    register_post_type( 'comic', array(
        'label' => 'Comic Post',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'has_archive' => true,
        'rewrite' => true,
        'query_var' => true,
    ));
}
add_action( 'init', 'burjagrita_post_init' );

function burjagrita_settings( $wp_customize ) {
    $wp_customize->add_section(
        'theming_section_id',
        array(
            'title' => 'Theming Options',
        )
    );
    $wp_customize->add_setting(
        'banner_settings_id',
        array(
            'default' => '',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'banner_control_id',
            array(
                'label' => __('Burjagrita Header', 'burjagrita'),
                'section' => 'theming_section_id',
                'settings' => 'banner_settings_id',
            )
        )
    );

    $wp_customize->add_setting(
        'site_display_id',
        array(
            'default' => bloginfo('name'),
        )
    );

    $wp_customize->add_control(
        'site_display_control_id',
        array(
            'label' => __('Site Display Title', 'burjagrita'),
            'section' => 'theming_section_id',
            'settings' => 'site_display_id',
        ),
    );
}
add_action( 'customize_register', 'burjagrita_settings' );

function widget_areas_init() {
    // Left part of the header bar
    register_sidebar( array (
        'name' => __('Lefthand Header'),
        'id' => 'lefthand-header',
        'description' => __( 'The lefthand side of the header bar' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class = "widget-title">',
        'after_title' => '</h3>',
        'before_sidebar' => '<div id="lefthand-container" class="header-element">',
        'after_sidebar' => '</div>',
    ) );

    // Right part of the header bar
    register_sidebar( array (
        'name' => __('Righthand Header'),
        'id' => 'righthand-header',
        'description' => __( 'The righthand side of the header bar' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '',
        'after_title' => '',
        'before_sidebar' => '<div id="righthand-container" class="header-element">',
        'after_sidebar' => '</div>',
    ) );

    // Left Home Page
    register_sidebar( array (
        'name' => __('Left Home'),
        'id' => 'left-home',
        'description' => __( 'The left part of the home page' ),
        'before_widget' => '<li id="%1$s" class="left-home %2$s">',
        'after_widget' => '</li>',
        'before_sidebar' => '<div id="left-home-container" class="home-page-area">',
        'after_sidebar' => '</div>',
    ) );
    // Middle Home Page
    register_sidebar( array (
        'name' => __('Middle Home'),
        'id' => 'middle-home',
        'description' => __( 'The middle part of the home page' ),
        'before_widget' => '<li id="%1$s" class="middle-home %2$s">',
        'after_widget' => '</li>',
        'before_sidebar' => '<div id="middle-home-container" class="home-page-area">',
        'after_sidebar' => '</div>',
    ) );
    // Right Home Page
    register_sidebar( array (
        'name' => __('Right Home'),
        'id' => 'right-home',
        'description' => __( 'The righthand side of the header bar' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_sidebar' => '<div id="right-home-container" class="home-page-area">',
        'after_sidebar' => '</div>',
    ) );
}
add_action( 'widgets_init', 'widget_areas_init' );


?>
