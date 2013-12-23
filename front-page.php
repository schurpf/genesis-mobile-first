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

add_action('genesis_before_content', 'gboo_portfolio');

function gboo_portfolio(){
?>
<h2>Current Projects</h2>
<div class="row">
        <div class="col-lg-4">
          <h3>Safari bug warning!</h3>
          <p class="text-danger">Safari exhibits a bug in which resizing your browser horizontally causes rendering errors in the justified nav that are cleared upon refreshing.</p>
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
add_action( 'genesis_sidebar', 'gboo_do_sidebar' );

}

function gboo_do_sidebar(){

echo genesis_html5() ? '<section class="widget widget_text">' : '<div class="widget widget_text">';
	echo '<div class="widget-wrap">';
?>	
		<p>Sidebar gboo</p>
<?php
	echo '</div>';
	echo genesis_html5() ? '</section>' : '</div>';	

}

genesis();