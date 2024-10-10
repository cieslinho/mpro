<?php
function register_menus()
{
	register_nav_menus(
		array(
			'account-menu' => esc_html__('account-menu', 'mpro'),
			'header-menu' => esc_html__('header-menu', 'mpro'),
			'categories-menu' => esc_html__('categories-menu', 'mpro'),
			'categories-header' => esc_html__('categories-header', 'mpro'),
			'footer-menu' => esc_html__('footer-menu', 'mpro'),
			'category-slider' => esc_html__('category-slider', 'mpro')
		)
	);
}
add_action('init', 'register_menus');
?>