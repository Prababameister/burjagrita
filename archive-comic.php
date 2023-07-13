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
            if ( $result-> have_posts() ) : ?>
                <?php while ( $result->have_posts() ) : $result->the_post(); ?>
                    <?php the_title(); ?>
                <?php endwhile; ?>
            <?php endif; wp_reset_postdata(); ?>

                <div id="content" role="main">

		        <?php the_post(); ?>
		        <h1 class="entry-title"><?php the_title(); ?></h1>

		        <?php get_search_form(); ?>

		        <h2>Archives by Month:</h2>
		        <ul>
			        <?php wp_get_archives(array(
                        'type' => 'monthly',
                        'post_type' => 'comic'
                    )); ?>
		        </ul>

		        <h2>Archives by Subject:</h2>
		        <ul>
			        <?php wp_list_categories(); ?>
		        </ul>

	        </div><!-- #content -->
        </div><!-- #container -->
        <?php
        get_sidebar();
        get_footer();
        ?>
    </body>
</html>
