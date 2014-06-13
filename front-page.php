<?php

/**
 * Home Page.
 *
 * @category   Genesis_Sandbox
 * @package    Templates
 * @subpackage Home
 * @author     Travis Smith and Jonathan Perez, for Surefire Themes
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://schurpf.com/
 * @since      1.0.0
 */


add_action( 'genesis_before_content', 'gmfb_portfolio' );

function gmfb_portfolio() {
?>

  <?php
  $args = array(  'post_type' => 'portfolio', 
                  'posts_per_page' => 3, 
                  'meta_key' => 'portfolio_weight',
                  'orderby' => 'meta_value', 
                  'order' => 'ASC' );
  $loop = new WP_Query( $args );
  $count = 0;
  while ( $loop->have_posts() ) : $loop->the_post();
  $count = $count + 1;
  if ($count == 1){
    ?>
      <h2>Portolio</h2>
      <div class="row">
    <?php 
  }

  if ( $count >2 ) { ?>
            <div class="hidden-xs hidden-sm col-sm-6 col-md-4">
          <?php }else { ?>
            <div class="col-sm-6 col-md-4">
          <?php }?>
          <?php $portfolio_url = get_field( 'portfolio_link' );
  if ( $portfolio_url == '' ) {
    $portfolio_url = '#';
  }?>

          <a href="<?php echo $portfolio_url;?>"><h3><?php the_title(); ?></h3></a>
          <?php echo get_hisrc_img_portfolio( $portfolio_url ); ?>
          <?php if ( get_field( 'portfolio_date' ) ): ?>
            <p class="portfolio-date"><?php the_field( 'portfolio_date' ); ?></p>
          <?php endif; ?>
          <?php if ( get_field( 'portfolio_description' ) ): ?>
            <p class="portfolio-description"><?php the_field( 'portfolio_description' );?></p>
          <?php endif; ?>
          </div>
          <?php endwhile;?>

          <?php if ($count>0){
            echo '</div>';
          } ?>
  <?php
}

remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
add_action( 'genesis_sidebar', 'gmfb_do_sidebar' );

function gmfb_do_sidebar() {

  echo genesis_html5() ? '<section class="widget widget_text">' : '<div class="widget widget_text">';
  echo '<div class="widget-wrap">';
?>
    <p>Sidebar gmfb</p>
<?php
  echo '</div>';
  echo genesis_html5() ? '</section>' : '</div>';

}

genesis();
