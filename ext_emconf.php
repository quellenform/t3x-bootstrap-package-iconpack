<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Iconpack for Bootstrap Package',
    'description' => 'Replaces the icons in bootstrap_package with iconpacks.',
    'category' => 'fe',
    'state' => 'excludeFromUpdates',
    'clearcacheonload' => true,
    'author' => 'Stephan Kellermayr',
    'author_email' => 'typo3@quellenform.at',
    'author_company' => 'Kellermayr KG',
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5-11.5.99',
            'iconpack' => '0.3-',
            'bootstrap_package' => '11.0-'
        ],
        'conflicts' => [],
        'suggests' => []
    ],
    'autoload' => [
        'psr-4' => ['Quellenform\\BootstrapPackageIconpack\\' => 'Classes']
    ],
];
