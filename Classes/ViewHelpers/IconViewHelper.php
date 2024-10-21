<?php

declare(strict_types=1);

namespace Quellenform\BootstrapPackageIconpack\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Quellenform\Iconpack\IconpackFactory;

/**
 * IconViewHelper
 */
class IconViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('icon', 'mixed', 'Icon to render', true);
        $this->registerArgument('height', 'int', 'Height');
        $this->registerArgument('width', 'int', 'Width');
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $icon = $this->arguments['icon'];

        if (isset($icon) && \is_string($icon)) {
            $additionalAttributes = [];
            if (isset($this->arguments['width'])) {
                $additionalAttributes['width'] = $this->arguments['width'];
            }
            if (isset($this->arguments['height'])) {
                $additionalAttributes['height'] = $this->arguments['height'];
            }
            /** @var IconpackFactory $iconpackFactory */
            $iconpackFactory = GeneralUtility::makeInstance(IconpackFactory::class);
            return $iconpackFactory->getIconMarkup(
                $icon,
                'native',
                $additionalAttributes
            ) ?? '';
        } else {
            if (isset($this->arguments['width'])) {
                $icon->setWidth((int) $this->arguments['width']);
            }
            if (isset($this->arguments['height'])) {
                $icon->setHeight((int) $this->arguments['height']);
            }

            return $icon->render();
        }
    }
}
