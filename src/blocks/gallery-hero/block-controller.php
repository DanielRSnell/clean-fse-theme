<?php
use Faker\Factory;

$context           = Timber::context();
$context['block']  = $block;
$context['fields'] = get_fields();

// Initialize Faker
$faker = Factory::create();
if ($is_preview) {
// Define default values using Faker
    $defaults = [
        'heading'               => $faker->sentence(4),
        'description'           => $faker->paragraph(2),
        'primary_button_text'   => $faker->words(2, true),
        'primary_button_link'   => $faker->url,
        'secondary_button_text' => $faker->words(3, true),
        'secondary_button_link' => $faker->url,
        'gallery'               => array_fill(0, 7, $faker->imageUrl(428, 926, 'nature', true)),
    ];

// Merge defaults with actual fields, preferring actual values when they exist
    $context['fields'] = array_merge($defaults, array_filter((array) $context['fields']));
}

// Ensure gallery images are loaded
if (! empty($context['fields']['gallery']) && is_array($context['fields']['gallery'])) {
    $context['fields']['gallery'] = array_map(function ($image) {
        return is_array($image) && isset($image['url']) ? $image['url'] : $image;
    }, $context['fields']['gallery']);
}

// Ensure we have exactly 7 images
$context['fields']['gallery'] = array_pad((array) $context['fields']['gallery'], 7, $faker->imageUrl(428, 926, 'nature', true));

Timber::render('@block/gallery-hero/block.twig', $context);
