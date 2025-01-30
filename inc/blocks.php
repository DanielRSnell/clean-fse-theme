<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'my_fse_theme_register_blocks');

function my_fse_theme_register_blocks() {
    $blocks_dir = get_template_directory() . '/src/blocks';
    $blocks = array_diff(scandir($blocks_dir), array('..', '.'));

    foreach ($blocks as $block) {
        $block_file = $blocks_dir . '/' . $block . '/block.php';
        if (file_exists($block_file)) {
            require_once $block_file;
        }
    }
}
