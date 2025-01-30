<?php
// Autoload Composer dependencies
require_once __DIR__ . '/vendor/autoload.php';

// Load core setup files
require_once get_template_directory() . '/inc/core/timber-setup.php';
require_once get_template_directory() . '/inc/core/carbon-fields-setup.php';

// Initialize Timber and Carbon Fields first
add_action('after_setup_theme', 'initialize_core_libraries', 5);
function initialize_core_libraries() {
    new TimberSetup();
    new CarbonFieldsSetup();
}

// Load other core theme functions
require_once get_template_directory() . '/inc/core/theme-setup.php';
require_once get_template_directory() . '/inc/core/enqueue-scripts.php';

// Load admin functionality
require_once get_template_directory() . '/inc/admin/block-manager.php';

// Load fields and options setup
require_once get_template_directory() . '/inc/fields-options.php';

// Load custom blocks
require_once get_template_directory() . '/inc/blocks.php';

// Load utility functions
require_once get_template_directory() . '/inc/utilities.php';

// Initialize the rest of the theme
add_action('after_setup_theme', 'initialize_theme', 10);
function initialize_theme() {
    new ThemeSetup();
    new EnqueueScripts();
}
