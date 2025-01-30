<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('accordion')
    ->add_fields(array(
        Field::make('text', 'accordion_name', 'Accordion Name')
            ->set_help_text('A unique name for this accordion group'),
        Field::make('complex', 'accordion_items', 'Accordion Items')
            ->add_fields(array(
                Field::make('text', 'title', 'Title'),
                Field::make('rich_text', 'content', 'Content'),
                Field::make('checkbox', 'default_open', 'Open by default')
            ))
    ))
    ->set_render_callback(function($fields, $attributes, $inner_blocks) {
        $context = Timber::context();
        $context['fields'] = $fields;
        $context['attributes'] = $attributes;
        
        Timber::render('src/blocks/accordion/block.twig', $context);
    });
