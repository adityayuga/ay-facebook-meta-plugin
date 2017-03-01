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

add_action( 'wp_head', 'ay_facebook_meta_tag' );

if ( !function_exists ( 'ay_facebook_meta_tag' ) ) :
    function ay_facebook_meta_tag() {
    	global $post;

		if(!is_singular( array('page', 'post'))) {
			return;
		} else {

			$post_id = $post->ID;
			$post_id = apply_filters( 'ay_facebook_meta_tag_id_value', $post_id);

			$type = 'article';
			$post = get_post($post->ID);
			$post_content = $post->post_content;
			$post_content = apply_filters('the_content', $post_content);
			$post_content = wp_strip_all_tags($post_content);
			//$post_content = str_replace(']]>', ']]&gt;', $post_content);
			$post_content = wp_trim_words($post_content, 20);

			$url = get_permalink();
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID))[0];
			$title = get_the_title($post->ID);

			$url = apply_filters( 'ay_facebook_meta_tag_url_value', $url);
			$type = apply_filters( 'ay_facebook_meta_tag_type_value', $type);
			$title = apply_filters( 'ay_facebook_meta_tag_title_value', $title);
			$post_content = apply_filters( 'ay_facebook_meta_tag_description_value', $post_content);
			$image = apply_filters( 'ay_facebook_meta_tag_image_value', $image);

			ob_start();
			?>
			<meta property="og:url"                content="<?php echo $url; ?>" />
			<meta property="og:type"               content="<?php echo $type; ?>" />
			<meta property="og:title"              content="<?php echo $title; ?>" />
			<meta property="og:description"        content="<?php echo $post_content; ?>" />
			<meta property="og:image"              content="<?php echo $image; ?>" />
			<?php
			$content = ob_get_clean();

			$content = apply_filters('ay_facebook_meta_tag_override_function', $content);

			echo $content;
		}
    }
endif;
