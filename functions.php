<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Enqueue styles and scripts
function my_fse_theme_enqueue_assets() {
    wp_enqueue_style( 'my-fse-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'my_fse_theme_enqueue_assets' );

// Register custom block category
function my_fse_theme_block_categories( $categories ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'hero-blocks',
                'title' => __( 'Hero Blocks', 'my-fse-theme' ),
            ),
        )
    );
}
add_filter( 'block_categories_all', 'my_fse_theme_block_categories', 10, 2 );

// Include block registration file
require_once get_template_directory() . '/inc/register-blocks.php';
