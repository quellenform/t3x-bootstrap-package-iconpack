<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Iconpack for Bootstrap Package',
    'description' => 'Replaces the icons in bootstrap_package with iconpacks.',
    'category' => 'fe',
    'state' => 'stable',
    'clearcacheonload' => true,
    'author' => 'Stephan Kellermayr',
    'author_email' => 'typo3@quellenform.at',
    'author_company' => 'Kellermayr KG',
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-13.4.99',
            'iconpack' => '1.3.0-1.99',
            'bootstrap_package' => '12.0.10-15.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
