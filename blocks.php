<?php

add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/block/header-block' );
    register_block_type( __DIR__ . '/block/category-slider-block' );

}

?>