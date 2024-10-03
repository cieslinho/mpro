<?php
/**
 * @package MPro
 */

error_reporting( 0 );

if ( ! defined( '_S_VERSION' ) ) {
	define( 'S_VERSION', '1.6.7' );
}

require_once 'inc/menus.php';
require_once 'inc/theme-supports.php';
require_once 'inc/filters.php';
// require_once 'cpt.php';
require_once 'blocks.php';

// require_once( get_stylesheet_directory() . '/customizer/customizer.php' );

function init_scripts() {
	/**
	 *  Main styles 
	 */
	wp_register_style( 'main-css', get_template_directory_uri() . '/assets/css/main.css?v=7.3', [], false, 'all' );
	wp_register_script( 'main-js', get_template_directory_uri() . '/assets/js/script.js?v=7.2', [], false, 'all' );

	wp_enqueue_style( 'main-css' );
	wp_enqueue_script( 'main-js' );
}
add_action( 'wp_enqueue_scripts', 'init_scripts' );

// function add_arrow_icon( $items, $args ) {
// 	if ( $args->theme_location == 'header-menu' ) {
// 		$pattern = '/<li[^>]*\bclass="[^"]*\bmenu-item-has-children\b[^"]*"[^>]*>/';

// 		$arrow_btn = '
//         <button type="button" class="top-navigation__menu-dropper">
//           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon"
//             xmlns="http://www.w3.org/2000/svg">
//           <g id="type=ep:arrow-up">
//               <path id="Vector"
//                 d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z"
//                 class="dropdown-icon" fill="white" />
//             </g>
//           </svg>
//         </button>';

// 		$items = preg_replace( $pattern, '$0' . $arrow_btn, $items );
// 	}

// 	return $items;
// }

// add_filter( 'wp_nav_menu_items', 'add_arrow_icon', 10, 2 );

// Default images for new animals
// function set_default_acf_thumbnail_image($post_id) {
// 	// Check if the post type is 'animals'
// 	if (get_post_type($post_id) === 'animals') {
// 			// Check if the 'thumbnail-image' ACF field is empty
// 			if (empty(get_field('thumbnail-image', $post_id))) {
// 					// Get the attachment ID for the default image
// 					$default_image_id = 305;

// 					// Update the 'thumbnail-image' ACF field with the default image ID
// 					update_field('thumbnail-image', $default_image_id, $post_id);

// 					// Remove default classes from the default image
// 					$default_image_classes = array();
// 					update_post_meta($default_image_id, '_wp_attachment_image_class', $default_image_classes);

// 					// Add the 'animal__image' class to the default image
// 					$new_image_classes = array('animal__image');
// 					update_post_meta($default_image_id, '_wp_attachment_image_class', $new_image_classes);
// 			}
// 	}
// }

// add_action('save_post', 'set_default_acf_thumbnail_image');
