<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function my_fse_theme_register_blocks() {
    $blocks = array(
        'home-hero',
    );

    foreach ( $blocks as $block ) {
        register_block_type( get_template_directory() . '/build/blocks/' . $block );
    }
}
add_action( 'init', 'my_fse_theme_register_blocks' );
