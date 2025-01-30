# Blocks

This directory contains custom blocks for the WordPress block editor (Gutenberg). Blocks can be created using either Advanced Custom Fields (ACF) or Carbon Fields.

## Block Compiler Option

To set the block compiler option, visit the [Block Manager](../../wp-admin/themes.php?page=block-manager) in the WordPress admin.

## File Structure

### ACF Blocks

For ACF blocks, use the following structure:

```
block-name/
├── block.json
├── block-controller.php
├── block.twig
└── components/
    ├── component-name.twig
    └── ...
```

- `block.json`: Defines the block's properties and settings.
- `block-controller.php`: Handles the block's PHP logic, sets up the Timber context, and provides default values using Faker.
- `block.twig`: Contains the block's main HTML structure using Twig templating.
- `components/`: Directory containing smaller, reusable Twig templates for the block.

### Carbon Fields Blocks

For Carbon Fields blocks, use the following structure:

```
block-name/
├── block.php
├── block.twig
└── components/
    ├── component-name.twig
    └── ...
```

- `block.php`: Defines the block, its fields, and render callback using Carbon Fields API.
- `block.twig`: Contains the block's main HTML structure using Twig templating.
- `components/`: Directory containing smaller, reusable Twig templates for the block.

## Usage

1. Choose your preferred block compiler (ACF or Carbon Fields) in the Block Manager.
2. Create a new directory for your block in this folder.
3. Add the necessary files based on the chosen compiler's structure.
4. Implement your block logic and template.

### Using Faker for Default Values

To provide a better editing experience, use Faker to generate default values for your block fields. This ensures that the block appears populated in the editor even before the user has entered any data.

Example usage in a block controller:

```php
use Faker\Factory;

$faker = Factory::create();

if ($is_preview) {
    $defaults = [
        'title' => $faker->sentence(4),
        'description' => $faker->paragraph(2),
        'gallery' => array_fill(0, 5, $faker->imageUrl(800, 600, 'nature', true)),
    ];

    $context['fields'] = array_merge($defaults, array_filter((array)get_fields()));
}
```

### ACF Block Example

```php
// block-controller.php
use Faker\Factory;

$context = Timber::context();
$context['block'] = $block;
$context['fields'] = get_fields();

$faker = Factory::create();

if ($is_preview) {
    $defaults = [
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'gallery' => array_fill(0, 5, $faker->imageUrl(800, 600, 'nature', true)),
    ];

    $context['fields'] = array_merge($defaults, array_filter((array)$context['fields']));
}

Timber::render('@block/block-name/block.twig', $context);
```

### Carbon Fields Block Example

```php
// block.php
use Carbon_Fields\Block;
use Carbon_Fields\Field;
use Faker\Factory;

Block::make('example_block')
    ->add_fields(array(
        Field::make('text', 'title', 'Title'),
        Field::make('rich_text', 'description', 'Description'),
        Field::make('media_gallery', 'gallery', 'Gallery'),
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $context = Timber::context();
        
        $faker = Factory::create();
        
        if (empty($fields['gallery'])) {
            $fields['gallery'] = array_fill(0, 5, $faker->imageUrl(800, 600, 'nature', true));
        }
        
        $context['fields'] = $fields;
        $context['attributes'] = $attributes;
        
        Timber::render('@block/block-name/block.twig', $context);
    });
```

## Notes

- Ensure you have the chosen framework (ACF or Carbon Fields) properly installed and activated in your WordPress setup.
- The block compiler choice affects how blocks are registered and rendered in the WordPress admin and frontend.
- Always use the `@block` namespace when rendering Twig templates for blocks.
- Use Faker to provide default values for a better editing experience.
- Organize your block's template into smaller, reusable components in the `components/` directory for better maintainability.

For more information on creating custom blocks, refer to the documentation of your chosen framework:
- [ACF Blocks](https://www.advancedcustomfields.com/resources/blocks/)
- [Carbon Fields Blocks](https://docs.carbonfields.net/learn/containers/gutenberg-blocks.html)
