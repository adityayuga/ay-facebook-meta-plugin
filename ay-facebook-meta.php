<?php
/**
  * Plugin Name: AY Facebook Meta
  * Plugin URI: https://github.com/adityayuga/ay-facebook-meta-plugin
  * Description: This plugin add Facebook Open Graph tags to our single posts.
  * Version: 1.0.0
  * Author: Aditya Yuga Pradhana
  * Author URI: https://github.com/adityayuga/
  * License: MIT
  */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', 'wp_new_user_notification' );

if ( !function_exists ( 'wp_new_user_notification' ) ) :
    function ay_facebook_meta_tag() {
	if( is_single() ) {
	?>
		<meta property="og:title" content"<?php the_title() ?>" />
		<meta property="og:site_name" content="<?php bloginfo('name') ?>" />
		<meta property="og:url" content="<?php the_permalink() ?>" />
		<meta property="og:description" content="<php the_excerpt() ?>" />
		<meta property="og:type" content="article" />
		
		<?php 
	      	if ( has_post_thumbnail() ) :
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); 
	    	?>
	      		<meta property="og:image" content="<?php echo $image[0]; ?>"/>  
		<?php endif;
	}
    }
endif;
