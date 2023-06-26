<?php

declare(strict_types=1);

namespace Quellenform\BootstrapPackageIconpack\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Quellenform\Iconpack\IconpackFactory;

/**
 * IconViewHelper
 */
class IconViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('icon', 'mixed', 'Icon to render', true);
        $this->registerArgument('height', 'int', 'Height');
        $this->registerArgument('width', 'int', 'Width');
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     * @throws \Exception
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $icon = $arguments['icon'];

        if (isset($icon) && \is_string($icon)) {
            $additionalAttributes = [];
            if (isset($arguments['width'])) {
                $additionalAttributes['width'] = $arguments['width'];
            }
            if (isset($arguments['height'])) {
                $additionalAttributes['height'] = $arguments['height'];
            }
            /** @var IconpackFactory $iconpackFactory */
            $iconpackFactory = GeneralUtility::makeInstance(IconpackFactory::class);
            return $iconpackFactory->getIconMarkup(
                $icon,
                'native',
                $additionalAttributes
            ) ?? '';
        } else {
            if (isset($arguments['width'])) {
                $icon->setWidth((int) $arguments['width']);
            }
            if (isset($arguments['height'])) {
                $icon->setHeight((int) $arguments['height']);
            }

            return $icon->render();
        }
    }
}
