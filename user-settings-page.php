<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php echo wp_title( '|', true, 'right' ) . " PBMBC"; ?></title>
        <?php wp_head(); ?>
    </head>
    <body>
        <?php
        wp_body_open();
        get_header();

        the_content();

        get_sidebar();
        get_footer();
        ?>
    </body>
</html>
