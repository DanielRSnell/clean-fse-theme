<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('example_block')
    ->add_fields(array(
        Field::make('text', 'title', 'Title'),
        Field::make('rich_text', 'content', 'Content'),
    ))
    ->set_description('A custom example block using Carbon Fields.')
    ->set_category('formatting')
    ->set_icon('smiley')
    ->set_keywords(array('example', 'carbon fields'))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $context = Timber::context();
        $context['fields'] = $fields;
        $context['attributes'] = $attributes;
        $context['inner_blocks'] = $inner_blocks;
        
        Timber::render('@block/template/carbon-block/block.twig', $context);
    });
