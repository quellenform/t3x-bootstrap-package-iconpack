<?php

declare(strict_types=1);

namespace Quellenform\BootstrapPackageIconpack\Icons;

/*
 * This file is part of the "bootstrap_package_iconpack" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use BK2K\BootstrapPackage\Icons\IconList;
use BK2K\BootstrapPackage\Icons\IconProviderInterface;

/**
 * IconpackProvider
 */
class IconpackProvider implements IconProviderInterface
{
    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return 'EXT:iconpack';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Iconpack Icons';
    }

    /**
     * @param string $identifier
     *
     * @return bool
     */
    public function supports(string $identifier): bool
    {
        return 'EXT:iconpack' === $identifier;
    }

    /**
     * Return an empty IconList, as the content is provided by a separate wizard.
     *
     * @return IconList
     */
    public function getIconList(): IconList
    {
        return new IconList();
    }
}
