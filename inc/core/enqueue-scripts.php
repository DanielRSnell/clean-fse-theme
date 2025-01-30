<?php
class EnqueueScripts {
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_editor_styles'));
    }

    public function enqueue_styles() {
        $stylesheet = $this->get_compiled_stylesheet();
        if ($stylesheet) {
            wp_enqueue_style('compiled-styles', $stylesheet['url'], array(), $stylesheet['version']);
        }
    }

    public function enqueue_scripts() {
        wp_enqueue_script('my-fse-theme-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
    }

    public function enqueue_editor_styles() {
        $stylesheet = $this->get_compiled_stylesheet();
        if ($stylesheet) {
            wp_enqueue_style('compiled-styles-editor', $stylesheet['url'], array(), $stylesheet['version']);
        }
    }

    private function get_compiled_stylesheet() {
        $compiled_stylesheet = get_template_directory() . '/compile/tailwind.css';
        if (file_exists($compiled_stylesheet)) {
            return array(
                'url' => get_template_directory_uri() . '/compile/tailwind.css',
                'version' => filemtime($compiled_stylesheet)
            );
        }
        return false;
    }
}
