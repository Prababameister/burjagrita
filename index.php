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
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
            endif;
            get_sidebar();
            get_footer();
        ?>
    </body>
</html>
