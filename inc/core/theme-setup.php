<?php
class ThemeSetup {
    public function __construct() {
        add_action('after_setup_theme', array($this, 'theme_supports'));
        add_action('init', array($this, 'register_menus'));
    }

    public function theme_supports() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo');
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
    }

    public function register_menus() {
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'my-fse-theme'),
            'footer' => __('Footer Menu', 'my-fse-theme'),
        ));
    }
}
