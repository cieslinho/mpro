<?php

add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/block/header-block' );
    register_block_type( __DIR__ . '/block/category-slider-block' );
    register_block_type( __DIR__ . '/block/latest-products-block' );
    register_block_type( __DIR__ . '/block/partners-block' );
    register_block_type( __DIR__ . '/block/latest-news-block' );
    register_block_type( __DIR__ . '/block/top-banner-block' );
    register_block_type( __DIR__ . '/block/bottom-banner-block' );
    register_block_type( __DIR__ . '/block/product-tabs-block' );
    register_block_type( __DIR__ . '/block/product-order-benefits-block' );
    register_block_type( __DIR__ . '/block/product-short-description-block' );
    register_block_type( __DIR__ . '/block/text-editor-block' );
    register_block_type( __DIR__ . '/block/contact-block' );
    register_block_type( __DIR__ . '/block/left-section-block' );
    register_block_type( __DIR__ . '/block/right-section-block' );
    register_block_type( __DIR__ . '/block/banner-block' );
}
?>