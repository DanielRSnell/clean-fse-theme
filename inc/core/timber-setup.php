<?php
use Timber\Timber;

class TimberSetup {
    public function __construct() {
        add_action('after_setup_theme', array($this, 'initialize_timber'), 9);
        add_filter('timber/locations', array($this, 'add_timber_locations'));
    }

    public function initialize_timber() {
        Timber::init();
        Timber::$dirname = array('templates', 'views');
    }

    public function add_timber_locations($paths) {
        $paths['block'] = [
            get_template_directory() . '/src/blocks',
        ];

        return $paths;
    }
}
