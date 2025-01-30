<?php
// Autoload Composer dependencies
require_once __DIR__ . '/vendor/autoload.php';

// Initialize Carbon Fields
add_action('after_setup_theme', 'crb_load');
function crb_load() {
    \Carbon_Fields\Carbon_Fields::boot();
}

// Load core theme functions
require_once get_template_directory() . '/inc/core/theme-setup.php';
require_once get_template_directory() . '/inc/core/enqueue-scripts.php';
require_once get_template_directory() . '/inc/core/timber-setup.php';

// Load admin functionality
require_once get_template_directory() . '/inc/admin/block-manager.php';

// Load fields and options setup
require_once get_template_directory() . '/inc/fields-options.php';

// Load custom blocks
require_once get_template_directory() . '/inc/blocks.php';

// Load utility functions
require_once get_template_directory() . '/inc/utilities.php';

// Initialize the theme
function initialize_theme() {
    new ThemeSetup();
    new EnqueueScripts();
    new TimberSetup();
}
add_action('after_setup_theme', 'initialize_theme');
