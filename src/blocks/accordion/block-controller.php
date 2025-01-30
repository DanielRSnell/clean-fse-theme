<?php
$context = Timber::context();
$context['block'] = $block;
$context['fields'] = get_fields();

Timber::render('src/blocks/accordion/block.twig', $context);
