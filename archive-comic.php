<?php
/**
* Template Name: Comic Archive Page
*/
?>
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
        ?>
        <div id="container">

            <?php
            $args = array(
                'post_type'=> 'comic',
                'orderby'    => 'ID',
                'post_status' => 'publish',
                'order'    => 'DESC',
                'posts_per_page' => -1 // this will retrive all the post that is published
            );
            $result = new WP_Query( $args );
            ?>

            <h1 id="archive-title"> Archive </h1>

            <div id="archive-section">
                <?php
                if ( $result-> have_posts() ) : ?>
                    <?php while ( $result->have_posts() ) : $result->the_post(); ?>
                        <div class="archive-entry">
                            <h1 class="archive-entry-title"> <?php the_title(); ?>: </h1>
                            <div class="comic-slider-hider">
                                <div class="comic-thumbnail moving-text">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_content(); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; wp_reset_postdata(); ?>
            </div>

	    </div><!-- #content -->
        <?php
        get_sidebar();
        get_footer();
        ?>
    </body>
</html>
