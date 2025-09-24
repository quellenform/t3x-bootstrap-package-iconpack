<?php

declare(strict_types=1);

namespace Quellenform\BootstrapPackageIconpack\EventListener;

/*
 * This file is part of the "bootstrap_package_iconpack" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use BK2K\BootstrapPackage\Events\ModifyIconProvidersEvent;
use BK2K\BootstrapPackage\Icons\GlyphiconsProvider;
use BK2K\BootstrapPackage\Icons\IoniconsProvider;

/**
 * Remove default icon providers from EXT:bootstrap_package
 */
final class ModifyIconProvidersEventListener
{
    /**
     * @var class-string[]
     */
    private array $iconProvidersToRemove = [
        GlyphiconsProvider::class,
        IoniconsProvider::class
    ];

    public function __invoke(ModifyIconProvidersEvent $event): void
    {
        $iconProviders = $event->getIconProviders();
        foreach ($iconProviders as $key => $iconProvider) {
            if (in_array(get_class($iconProvider), $this->iconProvidersToRemove, true)) {
                unset($iconProviders[$key]);
            }
        }
        $event->setIconProviders($iconProviders);
    }
}
