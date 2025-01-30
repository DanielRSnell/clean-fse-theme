<?php
use Timber\Timber;

class TimberSetup {
    public function __construct() {
        add_action('after_setup_theme', array($this, 'initialize_timber'));
    }

    public function initialize_timber() {
        Timber::init();
        Timber::$dirname = array('templates', 'views');
    }
}
