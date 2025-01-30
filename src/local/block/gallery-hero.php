<?php

if (function_exists('acf_add_local_field_group')) :

acf_add_local_field_group(array(
    'key' => 'group_gallery_hero',
    'title' => 'Gallery Hero',
    'fields' => array(
        array(
            'key' => 'field_heading',
            'label' => 'Heading',
            'name' => 'heading',
            'type' => 'text',
            'required' => 1,
        ),
        array(
            'key' => 'field_description',
            'label' => 'Description',
            'name' => 'description',
            'type' => 'textarea',
            'required' => 1,
        ),
        array(
            'key' => 'field_primary_button_text',
            'label' => 'Primary Button Text',
            'name' => 'primary_button_text',
            'type' => 'text',
        ),
        array(
            'key' => 'field_primary_button_link',
            'label' => 'Primary Button Link',
            'name' => 'primary_button_link',
            'type' => 'url',
        ),
        array(
            'key' => 'field_secondary_button_text',
            'label' => 'Secondary Button Text',
            'name' => 'secondary_button_text',
            'type' => 'text',
        ),
        array(
            'key' => 'field_secondary_button_link',
            'label' => 'Secondary Button Link',
            'name' => 'secondary_button_link',
            'type' => 'url',
        ),
        array(
            'key' => 'field_gallery',
            'label' => 'Gallery',
            'name' => 'gallery',
            'type' => 'gallery',
            'required' => 1,
            'min' => 7,
            'max' => 7,
            'insert' => 'append',
            'library' => 'all',
            'mime_types' => 'jpg, jpeg, png, gif',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/gallery-hero',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
));

endif;
