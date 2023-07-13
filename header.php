<div id="whole-header">
    <div id="header-bar">
        <?php
        $default_banner_loc = get_theme_file_uri('assets/images/banner.png');

        dynamic_sidebar('Lefthand Header');
        dynamic_sidebar('Righthand Header');
        ?>
    </div>

    <div id="profile-menu">
        <?php
        dynamic_sidebar('Profile Menu');
        ?>
    </div>

    <img id="header-banner"
         src="<?php echo ((get_theme_mod( 'banner_settings_id' ) == '') ?
                          $default_banner_loc :
                          esc_url( get_theme_mod( 'header_setting_id' ) )) ?>
             ">
</div>

<script type="text/javascript">
    var profilePicture = document.getElementById("block-14");

    var openProfileMenu = function() {
        profileMenu = document.getElementById("profile-menu");
        profileMenu.classList.toggle("open-profile-menu");
    }

    profilePicture.addEventListener('click', openProfileMenu, false);
</script>
