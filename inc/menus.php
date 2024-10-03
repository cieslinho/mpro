<?php
function register_menus()
{
	register_nav_menus(
		array(
			'account-menu' => esc_html__('account-menu', 'mpro'),
			'header-menu' => esc_html__('header-menu', 'mpro'),
			'footer-menu' => esc_html__('footer-menu', 'mpro'),
		)
	);
}
add_action('init', 'register_menus');
?>