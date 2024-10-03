<?php
/**
 * Disable WordPress Admin Bar for all users
*/
add_filter( 'show_admin_bar', '__return_true' );


/**
 * Add class to li element in menu
*/
function add_additional_class_on_li($classes, $item, $args) {
	if(isset($args->add_li_class)) {
			$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

/**
 * Change excerpt length and more string
 */
function change_excerpt($excerpt) {
	return substr($excerpt, 0, 150) . '...';
}

add_filter('the_excerpt', 'change_excerpt');