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

// add_filter( 'nav_menu_link_attributes', 'nav_menu_link_class', 10, 4 );

// function nav_menu_link_class(  $atts, $item, $args, $depth ) {

//       if ( 0 !== $depth ) {
//          $class         = 'nav__sublink';
//          $atts['class'] = $class;
//       }
//     return $atts;
// }

function custom_menu_classes($classes, $item, $args, $depth) {
    // Dodajemy klasę bazując na głębokości zagnieżdżenia
    $classes[] = 'sub-menu-depth-' . $depth;

    // Opcjonalnie: dodaj klasę tylko do elementów posiadających submenu
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'has-submenu-depth-' . $depth;
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'custom_menu_classes', 10, 4);