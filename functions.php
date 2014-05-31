<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis - Mobile First' );
define( 'CHILD_THEME_URL', 'http://www.mightyminnow.com/2013/08/our-new-mobile-first-child-theme-for-genesis-2-0/' );
define( 'CHILD_THEME_VERSION', '1.4' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


//Register JS
add_action('wp_enqueue_scripts', 'gemob_enque_scripts');
function gemob_enque_scripts(){
    wp_enqueue_script( 'gemob_hisrc', get_stylesheet_directory_uri() . '/js/hisrc/hisrc.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'gemob_js', get_stylesheet_directory_uri() . '/js/gemob.js', array( 'jquery' ), '', true );
    wp_enqueue_script('bootstrap_js', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js' );
}


/** Remove Header */
remove_action( 'genesis_header', 'genesis_do_header' );

//Bootstrap  navigation
require_once('wp_bootstrap_navwalker.php');
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

add_action( 'genesis_header', 'gboo_do_nav' );
function gboo_do_nav(  ) {
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="wrap">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </div>

        <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </div>
</nav>
<?php

/** Remove Title & Description */
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );


}

