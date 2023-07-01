<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php echo get_theme_mod('site_display_id'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body>
        <?php
        wp_body_open();
        get_header();
        ?>

        <div id="complete-home-section">
            <?php

            dynamic_sidebar('Left Home');

            dynamic_sidebar('Middle Home');

            dynamic_sidebar('Right Home');

            get_footer();
            ?>
        </div>
    </body>
</html>
