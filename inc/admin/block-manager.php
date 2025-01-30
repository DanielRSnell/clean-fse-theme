<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Register Carbon Fields
add_action('carbon_fields_register_fields', 'block_manager_options');

function block_manager_options() {
    Container::make('theme_options', __('Block Manager'))
        ->set_page_parent('themes.php') // Add as a submenu under Appearance
        ->set_page_file('block-manager')
        ->add_fields(array(
            Field::make('radio', 'block_compiler', __('Block Compiler'))
                ->set_options(array(
                    'acf' => 'Advanced Custom Fields (ACF)',
                    'carbon_fields' => 'Carbon Fields',
                ))
                ->set_default_value('carbon_fields')
                ->set_help_text('Choose which framework to use for compiling blocks.'),
        ));
}

// Add Block Manager to admin bar
add_action('admin_bar_menu', 'add_block_manager_to_admin_bar', 100);

function add_block_manager_to_admin_bar($admin_bar) {
    if (current_user_can('manage_options')) {
        $admin_bar->add_menu(array(
            'id'    => 'block-manager',
            'title' => 'Block Manager',
            'href'  => admin_url('themes.php?page=block-manager'),
            'meta'  => array(
                'title' => __('Block Manager'),
            ),
        ));
    }
}

// Remove the duplicate menu item
add_action('admin_menu', 'remove_duplicate_block_manager_menu', 999);

function remove_duplicate_block_manager_menu() {
    remove_submenu_page('themes.php', 'crb_carbon_fields_container_block_manager.php');
}
