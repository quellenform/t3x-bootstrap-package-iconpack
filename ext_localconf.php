<?php

defined('TYPO3') || die();

(function () {
    // Override ViewHelper
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][BK2K\BootstrapPackage\ViewHelpers\IconViewHelper::class] = [
    'className' => Quellenform\BootstrapPackageIconpack\ViewHelpers\IconViewHelper::class,
    ];
})();
