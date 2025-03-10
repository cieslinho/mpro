<?php
function register_menus()
{
	register_nav_menus(
		array(
			'account-menu' => esc_html__('account-menu', 'mpro'),
			'header-menu' => esc_html__('header-menu', 'mpro'),
			'categories-menu' => esc_html__('categories-menu', 'mpro'),
			'categories-header' => esc_html__('categories-header', 'mpro'),
			'category-slider' => esc_html__('category-slider', 'mpro'),
			'footer-contact' => esc_html__('footer-contact', 'mpro'),
			'footer-company' => esc_html__('footer-company', 'mpro'),
			'footer-categories' => esc_html__('footer-categories', 'mpro'),
			'footer-info' => esc_html__('footer-info', 'mpro')
		
			
		)
	);
}
add_action('init', 'register_menus');
?>