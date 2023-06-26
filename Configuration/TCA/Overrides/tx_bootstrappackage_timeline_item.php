<?php

defined('TYPO3') || die();

// Register fields
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_bootstrappackage_timeline_item',
    [
        'iconpack_enable' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_set',
            'onChange' => 'reload',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle'
            ]
        ],
        'iconpack' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon',
            'displayCond' => 'FIELD:iconpack_enable:REQ:true',
            'config' => [
                'type' => 'user',
                'renderType' => 'IconpackWizard'
            ]
        ]
    ]
);

// Override fields
$GLOBALS['TCA']['tx_bootstrappackage_timeline_item']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tx_bootstrappackage_timeline_item']['columns'],
    [
        'icon_file' => [
            'displayCond' => 'FIELD:iconpack_enable:REQ:false'
        ]
    ]
);

// Add custom fields to TCA
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_bootstrappackage_timeline_item',
    'iconpack_enable,--linebreak--,iconpack;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon',
    '',
    'replace:icon_set'
);

// Remove unused fields
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_bootstrappackage_timeline_item',
    '--palette--;;empty',
    '',
    'replace:icon_identifier'
);
