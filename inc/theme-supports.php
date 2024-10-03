<?php
add_theme_support('title-tag');

add_theme_support('custom-logo', array(
	'header-text' => array('site-title', 'site-description'),
	'height' => 100,
	'width' => 400,
	'flex-height' => true,
	'flex-width' => true
));

add_theme_support('automatic-feed-links');

add_theme_support('html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
	'script',
	'style'
));

add_editor_style();

add_theme_support('wp-block-styles');

add_theme_support('align-wide');

add_theme_support('post-thumbnails');

function remove_global_css()
{
	remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
	remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
}
add_action('init', 'remove_global_css');