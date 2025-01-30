<?php

// Check if ACF is active
function is_acf_active() {
    return class_exists('ACF');
}

// Set up ACF JSON save points
function my_acf_json_save_point($path) {
    return get_stylesheet_directory() . '/src/local';
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');

// Set up ACF JSON load points
function my_acf_json_load_point($paths) {
    $paths[] = get_stylesheet_directory() . '/src/local';
    return $paths;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

// Customize ACF JSON save paths
function custom_acf_json_save_paths($paths, $post) {
    $directory = get_stylesheet_directory() . '/src/local';

    switch ($post['type']) {
        case 'acf-field-group':
            if (isset($post['location']) && is_array($post['location'])) {
                foreach ($post['location'] as $location_group) {
                    foreach ($location_group as $location_rule) {
                        if ($location_rule['param'] === 'block' && $location_rule['operator'] === '==') {
                            $paths = array($directory . '/block');
                            return $paths;
                        }
                    }
                }
            }
            $paths = array($directory . '/fields');
            break;
        case 'acf-post-type':
            $paths = array($directory . '/post-types');
            break;
        case 'acf-taxonomy':
            $paths = array($directory . '/taxonomy');
            break;
        case 'acf-ui-options-page':
            $paths = array($directory . '/options');
            break;
    }

    return $paths;
}
add_filter('acf/json/save_paths', 'custom_acf_json_save_paths', 10, 2);

// Customize ACF JSON filenames
function custom_acf_json_filename($filename, $post, $load_path) {
    $filename = str_replace(
        array(' ', '_'),
        array('-', '-'),
        strtolower($post['title'])
    );

    return $filename . '.json';
}
add_filter('acf/json/save_file_name', 'custom_acf_json_filename', 10, 3);

// Load ACF or Carbon Fields based on availability
function load_fields_and_options() {
    if (is_acf_active()) {
        // Load ACF field groups, post types, taxonomies, and options
        $directories = array('fields', 'post-types', 'taxonomy', 'options', 'block');
        foreach ($directories as $dir) {
            $path = get_stylesheet_directory() . '/src/local/' . $dir;
            if (is_dir($path)) {
                $files = glob($path . '/*.php');
                foreach ($files as $file) {
                    require_once $file;
                }
            }
        }
    } else {
        // Load Carbon Fields as a fallback
        add_action('carbon_fields_register_fields', 'load_carbon_fields');
    }
}
add_action('init', 'load_fields_and_options', 5);

// Carbon Fields fallback
function load_carbon_fields() {
    $directories = array('fields', 'post-types', 'taxonomy', 'options', 'block');
    foreach ($directories as $dir) {
        $path = get_stylesheet_directory() . '/src/local/' . $dir;
        if (is_dir($path)) {
            $files = glob($path . '/*.php');
            foreach ($files as $file) {
                require_once $file;
            }
        }
    }
}
