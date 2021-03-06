<?php
//* Start the engine
include_once get_template_directory() . '/lib/init.php';

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
add_action( 'wp_enqueue_scripts', 'gmfb_enque_scripts' );
function gmfb_enque_scripts() {
    wp_enqueue_script( 'gmfb_hisrc', get_stylesheet_directory_uri() . '/js/hisrc/hisrc.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'gmfb_js', get_stylesheet_directory_uri() . '/js/gmfb.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'bootstrap_js_transition', get_stylesheet_directory_uri() . '/js/transition.js' );
    wp_enqueue_script( 'bootstrap_js_collapse', get_stylesheet_directory_uri() . '/js/collapse.js' );
}

// Remove Gensis Admin Menu (http://genesistutorials.com/define-genesis-default-options/)
remove_theme_support( 'genesis-admin-menu' );

/** Remove Header */
remove_action( 'genesis_header', 'genesis_do_header' );

//Bootstrap  navigation
require_once 'wp_bootstrap_navwalker.php';
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

add_action( 'genesis_header', 'gmfb_do_nav' );
function gmfb_do_nav(  ) {
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

            <a class="navbar-brand logo" href="<?php bloginfo( 'url' ); ?>">
                <?php bloginfo( 'name' ); ?>
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
            'walker'            => new wp_bootstrap_navwalker() )
    );
?>
    </div>
</nav>
<?php




}

/** Remove Title & Description */
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );


//Temporary add in CPT (needs to go in plugin later)
// define( 'ACF_LITE', true );
include_once 'advanced-custom-fields/acf.php';

add_action( 'init', 'gmfb_create_cpt' );

function gmfb_create_cpt() {

    $labels = array(
        'name' => __( 'Portfolio' ),
        'singular_name' => __( 'Portfolio' ),
        'add_new_item' => 'Add title/heading'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'portfolio' ),
    );

    register_post_type( 'portfolio', $args );
}

/**
 * Sortable Portoflio Column for weight
 */
add_action( 'admin_init', 'gmfb_portfolio_column' );
function gmfb_portfolio_column() {
    add_filter( 'manage_portfolio_posts_columns', 'gmfb_modify_user_table' );
    add_action( 'manage_portfolio_posts_custom_column', 'gmfb_modify_user_table_row', 10 );

    add_filter( 'manage_edit-portfolio_sortable_columns', 'gmfb_user_extra_sortable_cols' );
    add_filter( 'request', 'gmfb_user_extra_orderby' );
}

function gmfb_modify_user_table( $columns ) {
    $column_weight = array( 'portfolio_weight' => 'Weight' );

    $columns = array_slice( $columns, 0, 2, true ) + $column_weight + array_slice( $columns, 2, NULL, true );

    return $columns;
}

function gmfb_modify_user_table_row( $column, $post_id ) {
    $custom_fields = get_post_custom( $post_id );

    switch ( $column ) {
    case 'portfolio_weight' :
        echo $custom_fields['portfolio_weight'][0];
        break;

    default:
    }

}

function gmfb_user_extra_sortable_cols( $columns ) {
    //var_dump($columns);
    $custom = array(
        // meta column id => sortby value used in query
        'portfolio_weight'    => 'portfolio_weight',
    );
    return wp_parse_args( $custom, $columns );
}

function gmfb_user_extra_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'portfolio_weight' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
                'meta_key' => 'portfolio_weight',
                'orderby' => 'meta_value'
            ) );
    }
    return $vars;
}


// Helper functions
/**
 * return an image from attachment ID wrapped in HISRC markup
 *
 * @param string  $link          url
 * @param string  $width_mobile  number
 * @param string  $height_mobile numer
 * @return string                html
 */
function get_hisrc_img( $img_id, $link='', $width_mobile='200', $height_mobile='200' ) {
  $out = '';
  if ( $img_id !='' ) {
    $img_src_mobile = wp_get_attachment_image_src( $img_id, array( $width_mobile, $height_mobile ) );
    $img_src_desktop = wp_get_attachment_image_src( $img_id, array( 400, 400 ) );
    $out .= '<div class="hisrc">';
    if ( $link != '' ) {
      $out .= '<a href="'.$link.'"><img src="'.$img_src_mobile[0].'" width="'.$width_mobile.'" height="'.$height_mobile.'"
              data-1x="'.$img_src_desktop[0].'" alt="'.$post->post_title.'" /></a>';
    } else {
      $out .= '<img src="'.$img_src_mobile[0].'" width="'.$width_mobile.'" height="'.$height_mobile.'"
              data-1x="'.$img_src_desktop[0].'" alt="'.$post->post_title.'" />';
    }
    $out .= '</div>';
  }
  return $out;
}

/**
 * Get portfolio image marked up in HISRC markup
 *
 * @param string  $link          url
 * @param string  $width_mobile  number
 * @param string  $height_mobile number
 * @return string                html
 */
function get_hisrc_img_portfolio( $link='', $width_mobile='200', $height_mobile='200' ) {
  global $post;
  $img_id = get_field( 'portfolio_logo', $post->ID );
  return get_hisrc_img( $img_id, $link, $width_mobile, $height_mobile );
}

// if ( function_exists( 'add_image_size' ) ) {
//     add_image_size( 'portfolio', ,300 ); //300 pixels wide (and unlimited height)
//     add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
// }
