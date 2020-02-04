<?php
/**
 * Разметка Open Graph
 *
 * Plugin Name: Разметка Open Graph
 * Plugin URI:  https://jinsite.ru/raznoe/wp/item/1-facebook-open-graph
 * Description: Плагин реализует на сайте разметку Facebook Open Graph. Добавляет возможность вставки нужного изображения для соцсетей (используется установленное изображение записи). Если статья без изображений, в публикации статьи в соцсетях используется логотип сайта (работает только с логотипом из кастомайзера).
 * Version:     1.1
 * Author:      Евгений Поздняков
 * Author URI:  https://jinsite.ru
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: jsitewp-open-graph
 * Domain Path: /languages
 *
 */
if ( ! defined ( 'ABSPATH' ) ) {
	die ( 'Invalid request.' ) ;
}
define ( 'JSITEWP_OPEN_GRAPH_URL', plugin_dir_url ( __FILE__ ) );
function add_thumb () {
	add_theme_support ( 'post-thumbnails', array( 'post' ) );
}
add_action( 'after_setup_theme', 'add_thumb' );
function add_opengraph_doctype ( $output ) {
	return $output . ' xmlns:og="https://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml"';
}
add_filter ( 'language_attributes', 'add_opengraph_doctype' );
function jinsite_og_head () {
	global $post;
	if ( ! is_singular () )
		return;
		$blog_name = get_bloginfo ( 'name', 'display' );
		$post_id = $post->ID;
		if ( has_post_thumbnail ( $post->ID ) ) {
	    	$og_image = get_the_post_thumbnail_url ( $post_id );
		}
		else {
            $custom_logo__url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ); 
	    	$og_image =  $custom_logo__url[0]; 
		}
		echo '<meta property="og:title" content="' . get_the_title () . '"/>' . PHP_EOL;
		echo '<meta property="og:type" content="article"/>' . PHP_EOL;
		echo '<meta property="og:url" content="' . get_permalink () . '"/>' . PHP_EOL;
		echo '<meta property="og:site_name" content="' . $blog_name . '"/>' . PHP_EOL;
		echo '<meta property="og:image" content="' . $og_image . '"/>' . PHP_EOL;
}
add_action ( 'wp_head', 'jinsite_og_head', 5 );
?> 