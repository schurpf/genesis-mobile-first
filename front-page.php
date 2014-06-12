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

add_action('genesis_before_content', 'gmfb_portfolio');

function gmfb_portfolio(){
?>
<h2>Current Projects</h2>
<div class="row">
        
          <?php 
          $args = array( 'post_type' => 'portfolio', 'posts_per_page' => 3 );
          $loop = new WP_Query( $args );
          $count = 0;
          while ( $loop->have_posts() ) : $loop->the_post(); 
          $count = $count + 1;
          if ($count >2){ ?>
            <div class="hidden-xs hidden-sm col-sm-6 col-md-4"> 
          <?php }else { ?>
            <div class="col-sm-6 col-md-4">
          <?php }?>
          <?php $portfolio_url = get_field('portfolio_link');
          if ($portfolio_url == ''){
            $portfolio_url = '#';
          }?>

          <a href="<?php echo $portfolio_url;?>"><h3><?php the_title(); ?></h3></a>
          <?php $portfolio_img_id = get_field('portfolio_logo');
          if ($portfolio_img_id !='')
          {
            $img_src_mobile = wp_get_attachment_image_src($portfolio_img_id, array(200,200));
            $img_src_desktop = wp_get_attachment_image_src($portfolio_img_id, array(400,400));?>
          <div class="hisrc">
            <a href="<?php echo $portfolio_url;?>"><img src="<?php echo $img_src_mobile[0]; ?>" width="200" height="200"
            data-1x="<?php echo $img_src_desktop[0]; ?>"
            alt="<?php the_title(); ?>" /></a>
          </div>
          <?php } ?>
          <?php if( get_field('portfolio_date') ): ?>
            <p class="portfolio-date"><?php the_field('portfolio_date'); ?></p>
          <?php endif; ?>
          <?php if( get_field('portfolio_description') ): ?>
            <p class="portfolio-description"><?php the_field('portfolio_description');?></p>
          <?php endif; ?>
          </div>
          <?php endwhile;?>
        </div>
        <div class="row">
         <div class="col-lg-4">
          <h3>Lorem ipsum dolor sit.</h3>
          <div class="hisrc">
            <img src="http://upload.wikimedia.org/wikipedia/commons/6/6f/Earth_Eastern_Hemisphere.jpg" width="200" height="200"
            data-1x="http://placehold.it/400x400.png"
            data-2x="http://placehold.it/800x800.png"
            alt="Celebrating Halloween in style" />
          </div>
          <p class="text-danger">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, eius, debitis ipsam dolor dolores atque cum reprehenderit nisi omnis aperiam.</p>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#" role="button">View details >></a></p>
        </div>
        <div class="col-lg-4">
          <h3>Heading</h3>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#" role="button">View details >></a></p>
       </div>
        <div class="col-lg-4">
          <h3>Heading</h3>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
          <p><a class="btn btn-primary" href="#" role="button">View details >></a></p>
        </div>
      </div>
<?php
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
add_action( 'genesis_sidebar', 'gmfb_do_sidebar' );

}

function gmfb_do_sidebar(){

echo genesis_html5() ? '<section class="widget widget_text">' : '<div class="widget widget_text">';
	echo '<div class="widget-wrap">';
?>	
		<p>Sidebar gmfb</p>
<?php
	echo '</div>';
	echo genesis_html5() ? '</section>' : '</div>';	

}

genesis();