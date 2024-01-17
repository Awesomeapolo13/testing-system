<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude(['var', 'vendor'])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'cast_spaces' => [
            'space' => 'none',
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'types_spaces' => [
            'space_multiple_catch' => 'single',
        ],
        'single_line_throw' => false,
        'global_namespace_import' => [
            'import_classes' => true,
        ],
        'php_unit_method_casing' => [
            'case' => 'snake_case',
        ],
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ],
    ])
    ->setFinder($finder)
;
