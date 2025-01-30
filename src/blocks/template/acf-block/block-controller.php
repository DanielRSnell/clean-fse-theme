<?php
use Faker\Factory;

$context = Timber::context();
$context['block'] = $block;
$context['fields'] = get_fields();

// Initialize Faker
$faker = Factory::create();

if ($is_preview) {
    // Define default values using Faker
    $defaults = [
        'title' => $faker->sentence(4),
        'description' => $faker->paragraph(2),
        'gallery' => array_fill(0, 5, $faker->imageUrl(800, 600, 'nature', true)),
    ];

    // Merge defaults with actual fields, preferring actual values when they exist
    $context['fields'] = array_merge($defaults, array_filter((array) $context['fields']));
}

// Ensure gallery images are loaded
if (!empty($context['fields']['gallery']) && is_array($context['fields']['gallery'])) {
    $context['fields']['gallery'] = array_map(function ($image) {
        return is_array($image) && isset($image['url']) ? $image['url'] : $image;
    }, $context['fields']['gallery']);
}

Timber::render('@block/template/acf-block/block.twig', $context);
