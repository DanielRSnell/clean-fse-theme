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
