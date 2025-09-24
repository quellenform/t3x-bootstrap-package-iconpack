<?php

declare(strict_types=1);

namespace Quellenform\BootstrapPackageIconpack\Icons;

/*
 * This file is part of the "bootstrap_package_iconpack" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use BK2K\BootstrapPackage\Icons\AbstractIcon;
use Quellenform\Iconpack\IconpackFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * IconpackIcon
 */
class IconpackIcon extends AbstractIcon
{
    /**
     * @return string
     */
    public function render(): string
    {
        return GeneralUtility::makeInstance(IconpackFactory::class)->getIconMarkup(
            $this->getIdentifier(),
            'native'
        );
    }
}
