<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php echo wp_title( '|', true, 'right' ) . get_theme_mod('site_display_id'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body>
        <!-- Header Content -->
        <?php
        wp_body_open();
        get_header();
        ?>

        <!-- Center Section -->
        <div id="center-section">
            <!-- Title Content -->
            <div id="meta-info" class="center-section-element">
                <h1 id="comic-title"> <?php the_title(); ?> </h1>
                <h4 id="comic-date"> <?php echo get_the_date('d/j/y'); ?> </h4>
            </div>

            <!-- Actual Comic -->
            <div id="comic-section" class="center-section-element">
                <?php
                if (have_posts()) :
                while (have_posts()) :
                the_post();
                the_content();
                endwhile;
                endif;
                ?>
            </div>

            <!-- TODO Make a better placeholder button and style all of this -->
            <div id="nav-menu" class="center-section-element">
                <?php
                // Actually create the button
                function create_button ( $link, $class_str = '', $button_image_id = '') {
                    $button_image_src = ($button_image_id == '' ? (get_template_directory_uri() . '/assets/images/button-placeholder.png') : $button_image_id);

                    echo
                    '<li class="nav-item ' . $class_str . '">
                        <a href=' . $link . '>
                            <img src="' . $button_image_src . '">
                        </a>
                    </li>
                    ';
                }
                function create_button_spacer () {
                    echo
                    '<li class="nav-item spacer-list-item">
                        <div id="spacer-div">
                        </div>
                    </li>
                    ';

                }

                // Navigation links
                function get_first_comic_link() {
                    global $post;
                    $loop = get_posts( 'numberposts=1&order=ASC&post_type=comic' );
                    $first = $loop[0]->ID;

                    return get_permalink($first);
                }
                function get_previous_comic_link() {
                    return get_permalink(get_adjacent_post(false,'',true));
                }
                function get_random_comic_link() {
                    global $post;
                    $loop = get_posts( 'numberposts=1&orderby=rand&post_type=comic' );
                    $rand = $loop[0]->ID;

                    return get_permalink($rand);
                }
                function get_next_comic_link() {
                    return get_permalink(get_adjacent_post(false,'',false));
                }
                function get_latest_comic_link() {
                    global $post;
                    $loop = get_posts( 'numberposts=1&post_type=comic' );
                    $latest = $loop[0]->ID;

                    return get_permalink($latest);
                }

                // Check if this is the first or last post
                function is_latest() {
                    global $post;
                    $loop = get_posts( 'numberposts=1&post_type=comic' );
                    $latest = $loop[0]->ID;
                    return ( $post->ID == $latest ) ? true : false;
                }
	            function is_first() {
                    global $post;
                    $loop = get_posts( 'numberposts=1&order=ASC&post_type=comic' );
                    $first = $loop[0]->ID;
                    return ( $post->ID == $first ) ? true : false;
                }
                ?>

                <ul class="comic-nav-list">
                    <?php
                    if ( is_first() ) {
                        create_button_spacer();
                        create_button_spacer();
                    } else {
                        create_button( get_first_comic_link(), 'left-align-button', get_theme_mod( 'first-button-id' ) );
                        create_button( get_previous_comic_link(), 'left-align-button', get_theme_mod( 'previous-button-id' ) );
                    }
                    create_button( get_random_comic_link(), 'center-align-button', get_theme_mod( 'random-button-id' ) );
                    if ( is_latest() ) {
                        create_button_spacer();
                        create_button_spacer();
                    } else {
                        create_button( get_next_comic_link(), 'right-align-button', get_theme_mod( 'next-button-id' ) );
                        create_button( get_latest_comic_link(), 'right-align-button', get_theme_mod( 'latest-button-id' ) );
                    }
                    ?>
                </ul>
            </div>
        </div>
    </body>
</html>
