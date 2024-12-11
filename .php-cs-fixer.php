<?php
$config = new PhpCsFixer\Config();
return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PER-CS2.0:risky' => true,
        '@PER-CS2.0' => true,
        '@PHP84Migration' => true,
        '@PHP83Migration' => true,
        '@PhpCsFixer:risky' => true,
        '@PhpCsFixer' => true,
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->in(['./example', './work'])
    );
