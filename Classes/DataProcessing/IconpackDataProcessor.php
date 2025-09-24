<?php

declare(strict_types=1);

namespace Quellenform\BootstrapPackageIconpack\DataProcessing;

/*
 * This file is part of the "bootstrap_package_iconpack" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use BK2K\BootstrapPackage\Icons\FileIcon;
use BK2K\BootstrapPackage\Service\IconService;
use Quellenform\BootstrapPackageIconpack\Icons\IconpackIcon;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\DataProcessing\FilesProcessor;

/**
 * Minimal TypoScript configuration
 *
 * 10 = Quellenform\BootstrapPackageIconpack\DataProcessing\IconpackDataProcessor
 * 10 {
 *   iconSetFieldName = icon_set
 *   iconIdentifier.field = icon
 *   iconFileFieldName = icon_file
 *   as = icon
 * }
 */
class IconpackDataProcessor implements DataProcessorInterface
{
    /**
     * @var IconService
     */
    protected $iconService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->iconService = GeneralUtility::makeInstance(IconService::class);
    }

    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     *
     * @return array the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $icon = null;
        $config = [
            'iconSet' => (string) $cObj->stdWrapValue('iconSet', $processorConfiguration, ''),
            'iconIdentifier' => (string) $cObj->stdWrapValue('iconIdentifier', $processorConfiguration, ''),
            'iconFileFieldName' => (string) $cObj->stdWrapValue('iconFileFieldName', $processorConfiguration, '')
        ];
        if ((bool) $config['iconSet'] && $config['iconIdentifier'] !== '') {
            // Return a simple IconpackIcon without a preview image as we will only need the identifier later.
            $icon = (new IconpackIcon())
                ->setIdentifier($config['iconIdentifier'])
                ->setName($config['iconIdentifier'])
                ->setPreviewImage('') ?? null;
        } elseif ($config['iconFileFieldName'] !== '') {
            $filesProcessor = GeneralUtility::makeInstance(FilesProcessor::class);
            $filesData = $filesProcessor->process(
                $cObj,
                $contentObjectConfiguration,
                ['references.' => ['fieldName' => $config['iconFileFieldName']]],
                ['data' => $processedData['data']]
            );
            if (isset($filesData['files'][0])) {
                $file = $filesData['files'][0];
                $icon = (new FileIcon())
                    ->setFile($file)
                    ->setIdentifier($file->getIdentifier())
                    ->setName($file->getName())
                    ->setPreviewImage($file->getPublicUrl());
            }
        }

        $targetVariableName = (string) $cObj->stdWrapValue('as', $processorConfiguration, 'icon');
        $processedData[$targetVariableName] = $icon;

        return $processedData;
    }
}
