<?php
/**
 * Разметка Open Graph
 *
 * Plugin Name: Разметка Open Graph
 * Plugin URI:  https://jinsite.ru
 * Description: Плагин реализует на сайте разметку Facebook Open Graph. Добавляет возможность вставки нужного изображения для соцсетей. Если статья без изображений, в публикации статьи в соцсетях используется логотип сайта.
 * Version:     1.0
 * Author:      Евгений Поздняков
 * Author URI:  https://jinsite.ru
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: jsitewp-open-graph
 * Domain Path: /languages
 *
 */
if ( ! defined ( 'ABSPATH' ) ) {
	die ( 'Invalid request.' )  ;
}
define ( 'JSITEWP_OPEN_GRAPH_URL', plugin_dir_url ( __FILE__ ) );
function add_opengraph_doctype	( $output ) {
	return $output . ' xmlns:og="https://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml"';
	}
	add_filter ( 'language_attributes', 'add_opengraph_doctype' ) ;
function jinsite_og_head () {
	global $post;
	if ( ! is_singular () )
		return;
		echo '<meta property="og:title" content="' . get_the_title () . '"/>';
		echo '<meta property="og:type" content="article"/>';
		echo '<meta property="og:url" content="' . get_permalink () . '"/>';
		echo '<meta property="og:site_name" content="' . bloginfo ( 'name' ) . '"/>';
		if ( ! has_post_thumbnail ( $post->ID ) ) {
		$default_logo_image = wp_get_attachment_image_src ( get_theme_mod ( 'custom_logo' ) , 'full' ); 
		echo '<meta property="og:image" content="' . $default_logo_image . '"/>';
	} else {
		$thumbnail_src = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ) , 'medium' );
		echo '<meta property="og:image" content="' . esc_attr ( $thumbnail_src [0] ) . '"/>';
	}
	echo "";
	}
add_action ( 'wp_head', 'jinsite_og_head', 5 );
?>
