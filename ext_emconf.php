<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Iconpack for Bootstrap Package',
    'description' => 'Replaces the icons in bootstrap_package with iconpacks.',
    'category' => 'fe',
    'state' => 'beta',
    'clearcacheonload' => true,
    'author' => 'Stephan Kellermayr',
    'author_email' => 'typo3@quellenform.at',
    'author_company' => 'Kellermayr KG',
    'version' => '0.2.2',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.11-13.9.99',
            'iconpack' => '1.1.7-1.99',
            'bootstrap_package' => '12.0.10-14.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
