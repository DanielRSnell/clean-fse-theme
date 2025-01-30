<?php
require_once __DIR__ . '/vendor/autoload.php';

use Timber\Timber;
use Carbon_Fields\Carbon_Fields;

// Initialize Timber
Timber::init();

// Initialize Carbon Fields
add_action('after_setup_theme', function() {
    Carbon_Fields::boot();
});

// Include Carbon Fields block definitions
require_once __DIR__ . '/inc/blocks.php';

// Function to get compiled stylesheet details
function get_compiled_stylesheet() {
    $compiled_stylesheet = get_template_directory() . '/compile/tailwind.css';
    if (file_exists($compiled_stylesheet)) {
        return array(
            'url' => get_template_directory_uri() . '/compile/tailwind.css',
            'version' => filemtime($compiled_stylesheet)
        );
    }
    return false;
}

// Enqueue compiled stylesheet for frontend
function enqueue_compiled_stylesheet_frontend() {
    $stylesheet = get_compiled_stylesheet();
    if ($stylesheet) {
        wp_enqueue_style('compiled-styles', $stylesheet['url'], array(), $stylesheet['version']);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_compiled_stylesheet_frontend');

// Enqueue compiled stylesheet for block editor
function enqueue_compiled_stylesheet_editor() {
    $stylesheet = get_compiled_stylesheet();
    if ($stylesheet) {
        wp_enqueue_style('compiled-styles-editor', $stylesheet['url'], array(), $stylesheet['version']);
    }
}
add_action('enqueue_block_editor_assets', 'enqueue_compiled_stylesheet_editor');
