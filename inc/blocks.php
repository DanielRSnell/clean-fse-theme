<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action('init', 'my_fse_theme_register_blocks');

function my_fse_theme_register_blocks() {
    $block_compiler = get_block_compiler();
    $blocks_dir = get_template_directory() . '/src/blocks';
    
    if (!is_dir($blocks_dir)) {
        return;
    }

    $blocks = array_diff(scandir($blocks_dir), array('..', '.'));

    foreach ($blocks as $block) {
        $block_dir = $blocks_dir . '/' . $block;
        
        if ($block_compiler === 'acf' && file_exists($block_dir . '/block.json')) {
            register_block_type($block_dir);
        } elseif ($block_compiler === 'carbon_fields' && file_exists($block_dir . '/block.php')) {
            require_once $block_dir . '/block.php';
        }
    }
}

// ACF Block Render Callback
function my_fse_theme_acf_block_render_callback($block, $content = '', $is_preview = false, $post_id = 0) {
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;
    $context['post_id'] = $post_id;

    $slug = str_replace('acf/', '', $block['name']);
    
    if (file_exists(get_theme_file_path("/src/blocks/{$slug}/block-controller.php"))) {
        include(get_theme_file_path("/src/blocks/{$slug}/block-controller.php"));
    } else {
        Timber::render("@block/{$slug}/block.twig", $context);
    }
}

// Register ACF Block Category
add_filter('block_categories_all', 'my_fse_theme_block_category', 10, 2);

function my_fse_theme_block_category($categories, $post) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'my-fse-theme-blocks',
                'title' => __('My FSE Theme Blocks', 'my-fse-theme'),
            ),
        )
    );
}
