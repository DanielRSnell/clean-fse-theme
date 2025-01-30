# Block

This directory contains ACF field group definitions specific to blocks.

## Usage with @block Namespace

When creating block controllers or render callbacks, use the `@block` namespace to reference your Twig templates. For example:

```php
Timber::render('@block/block-name/block.twig', $context);
```

This ensures consistency across your theme and makes it easier to locate and manage block templates.

Remember to keep your block.twig files in the corresponding block directory under src/blocks/.
