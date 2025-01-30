<?php
use Carbon_Fields\Carbon_Fields;

class CarbonFieldsSetup {
    public function __construct() {
        add_action('after_setup_theme', array($this, 'boot_carbon_fields'), 10);
    }

    public function boot_carbon_fields() {
        Carbon_Fields::boot();
    }
}
