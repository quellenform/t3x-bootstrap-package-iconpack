<?php

defined('TYPO3') || die();

// Register fields
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'pages',
    [
        'page_icon_enable' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_set',
            'onChange' => 'reload',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle'
            ]
        ]
    ]
);

// Override display conditions for icon fields from EXT:bootstrap_package and EXT:iconpack
$GLOBALS['TCA']['pages']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['pages']['columns'],
    [
        'page_icon' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon',
            'displayCond' => 'FIELD:page_icon_enable:REQ:true'
        ],
        'nav_icon' => [
            'displayCond' => 'FIELD:page_icon_enable:REQ:false'
        ]
    ]
);

// Remove original icon field from EXT:iconpack
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    '--palette--;;empty',
    '1,3,4',
    'replace:page_icon'
);

// Replace icon switch in EXT:bootstrap_package
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    'page_icon_enable,--linebreak--,page_icon',
    '1,3,4',
    'replace:nav_icon_set'
);
