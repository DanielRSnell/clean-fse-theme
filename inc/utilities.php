<?php
// Add any utility functions here

function get_block_compiler() {
    if (function_exists('carbon_get_theme_option')) {
        $compiler = carbon_get_theme_option('block_compiler');
        return $compiler ? $compiler : 'carbon_fields';
    }
    // Fallback value if Carbon Fields is not active
    return 'carbon_fields';
}

// Add more utility functions as needed
