<?php

defined('TYPO3') || die();

(function () {
    // Register custom iconpack for template icons (social, fileicons, etc.)
    if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('iconpack')) {
        \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \Quellenform\Iconpack\IconpackRegistry::class
        )->registerIconpack(
            'EXT:bootstrap_package_iconpack/Configuration/Iconpack/BootstrapPackageIconpack.yaml',
            \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
            )->get('bootstrap_package_iconpack', 'configFile')
        );
    }
    // Register EXT:iconpack as iconProvider for EXT:bootstrap_package and remove these useless default providers...
    if (version_compare(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version(), '12', '<')) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/icons']['provider'][\Quellenform\BootstrapPackageIconpack\Icons\IconpackProvider::class]
            = \Quellenform\BootstrapPackageIconpack\Icons\IconpackProvider::class;
        $removeIconProviders = [
            \BK2K\BootstrapPackage\Icons\GlyphiconsProvider::class,
            \BK2K\BootstrapPackage\Icons\IoniconsProvider::class
        ];
        foreach ($removeIconProviders as $iconProvider) {
            unset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/icons']['provider'][$iconProvider]);
        }
    }
})();
