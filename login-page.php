<?php
/**
* Template Name: Login Page
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

        <div id="login-content">
            <div id="login-section" class="login-panel">
                <?php
                if ( ! is_user_logged_in() ) {
                    $args = array(
                        'form_id' => 'pbmb-login-form',
                        'redirect' => home_url(),
                        'label_username' => '✉️',
                        'label_password' => '🔑',
                        'label_log_in' => '   ↦ ',
                        'remember' => true
                    );
                    wp_login_form( $args );
                } else {
                    wp_loginout( home_url() );
                }

                the_content();
                ?>

            </div>
            <div id="login-img" class="login-panel">
                <h1 id="login-title">Welcome Back!</h1>
                <img id="salutation-img" src="<?php echo get_theme_file_uri('assets/images/waving.gif'); ?>">
            </div>
        </div>

        <?php
        get_footer();
        ?>
    </body>
</html>
