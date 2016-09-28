<?php

$fixers = [
    'short_array_syntax',
    'ordered_use',
    'unused_use',
    'php_unit_construct',
    'strict',
    'strict_param',
];

$finder = Symfony\CS\Finder\DefaultFinder::create();
$finder->in(__DIR__ . '/src');
$finder->in(__DIR__ . '/tests');

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers($fixers)
    ->finder($finder);
