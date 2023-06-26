<?php

defined('TYPO3') || die();

// Add static typoscript configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'bootstrap_package_iconpack',
    'Configuration/TypoScript/',
    'Iconpack for "Bootstrap Package"'
);
