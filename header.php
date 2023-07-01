<div id="header-bar">
<?php
$default_banner_loc = get_theme_file_uri('assets/images/banner.png');

dynamic_sidebar('Lefthand Header');
dynamic_sidebar('Righthand Header');
?>
</div>

<img id="header-banner"
     src="<?php echo ((get_theme_mod( 'banner_settings_id' ) == '') ?
                      $default_banner_loc :
                      esc_url( get_theme_mod( 'header_setting_id' ) )) ?>
         ">
