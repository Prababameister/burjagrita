<?php
function shortcode_user_avatar() {
    if(is_user_logged_in()) {
        global $current_user;
        get_currentuserinfo();
        return '<div id="profile-picture-button">' . get_avatar( $current_user -> ID, 120 ) . '</div>';
    }
    else {
        // If not logged in then show default avatar. Change the URL to show your own default avatar
        return '<div id="log-in-button"> <a style="font-size: 20px;" href="' . get_site_url() . '/login">Login</a> </div>';
    }
}
add_shortcode('display-user-avatar','shortcode_user_avatar');

function burjagrita_css_scripts () {
    wp_enqueue_style('header_styles', get_theme_file_uri('assets/css/header_styles.css'), false, '1.1', 'all');
    wp_enqueue_style('home_styles', get_theme_file_uri('assets/css/home_styles.css'), false, '1.1', 'all');
    wp_enqueue_style('post_styles', get_theme_file_uri('assets/css/post_styles.css'), false, '1.1', 'all');
    wp_enqueue_style('comments_styles', get_theme_file_uri('assets/css/comments_styles.css'), false, '1.1', 'all');
    wp_enqueue_style('footer_styles', get_theme_file_uri('assets/css/footer_styles.css'), false, '1.1', 'all');

    wp_enqueue_style('main-style', get_stylesheet_uri(), false, '20150320');
    $righteous_font = "@font-face { font-family: Righteous-Regular; src: url(" . get_theme_file_uri('assets/fonts/Righteous-Regular.ttf') . "); font-weight: normal; }";
    $pinchik_font = "@font-face { font-family: Pinchik-Light; src: url( " . get_theme_file_uri('assets/fonts/Pinchik-Light.otf') . "); font-weight: normal; }";
    wp_add_inline_style('main-style', $righteous_font);
    wp_add_inline_style('main-style', $pinchik_font);
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
        'supports' => array('title','editor','author','excerpt','comments','revisions'),
    ));
}
add_action( 'init', 'burjagrita_post_init' );

function wpdocs_comments_open( $open, $post_id ) {
	$post = get_post( $post_id );
	if ( 'page' == $post->post_type )
		$open = true;
	return $open;
}
add_filter( 'comments_open', 'wpdocs_comments_open', 10, 2 );

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
    $wp_customize->add_setting(
        'site_display_id',
        array(
            'default' => bloginfo('name'),
        )
    );

    // TODO Replace this with a method of some kind to reduce the boilerplate
    // Buttons
    $wp_customize->add_setting(
        'first_button_settings_id',
        array(
            'default' => '',
        )
    );
    $wp_customize->add_setting(
        'previous_button_settings_id',
        array(
            'default' => '',
        )
    );
    $wp_customize->add_setting(
        'random_button_settings_id',
        array(
            'default' => '',
        )
    );
    $wp_customize->add_setting(
        'next_button_settings_id',
        array(
            'default' => '',
        )
    );
    $wp_customize->add_setting(
        'latest_button_settings_id',
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
    $wp_customize->add_control(
        'site_display_control_id',
        array(
            'label' => __('Site Display Title', 'burjagrita'),
            'section' => 'theming_section_id',
            'settings' => 'site_display_id',
        ),
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'first_button_id',
            array(
                'label' => __('First Button', 'burjagrita'),
                'section' => 'theming_section_id',
                'settings' => 'first_button_settings_id',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'previous_button_id',
            array(
                'label' => __('Previous Button', 'burjagrita'),
                'section' => 'theming_section_id',
                'settings' => 'previous_button_settings_id',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'random_button_id',
            array(
                'label' => __('Random Button', 'burjagrita'),
                'section' => 'theming_section_id',
                'settings' => 'random_button_settings_id',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'next_button_id',
            array(
                'label' => __('Next Button', 'burjagrita'),
                'section' => 'theming_section_id',
                'settings' => 'next_button_settings_id',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'latest_button_id',
            array(
                'label' => __('Latest Button', 'burjagrita'),
                'section' => 'theming_section_id',
                'settings' => 'latest_button_settings_id',
            )
        )
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

    // Profile Menu
    register_sidebar( array (
        'name' => __('Profile Menu'),
        'id' => 'profile-menu-sidebar',
        'description' => __( 'The profile menu section of the website' ),
        'before_widget' => '<li id="%1$s" class="profile-menu-widget %2$s">',
        'after_widget' => '</li>',
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
