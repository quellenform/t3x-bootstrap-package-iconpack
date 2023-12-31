<?php

defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_bootstrappackage_accordion_item',
    [
        'iconpack' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon',
            'config' => [
                'type' => 'user',
                'renderType' => 'IconpackWizard',
            ]
        ]
    ]
);

// Add custom fields to TCA
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_bootstrappackage_accordion_item',
    'iconpack;LLL:EXT:iconpack/Resources/Private/Language/locallang_be.xlf:tt_content.header_icon',
    '',
    'before:header'
);
