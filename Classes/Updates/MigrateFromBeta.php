<?php

declare(strict_types=1);

namespace Quellenform\BootstrapPackageIconpack\Updates;

/*
 * This file is part of the "bootstrap_package_iconpack" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard('bootstrapPackageIconpack_migrateFromBeta')]
final class MigrateFromBeta implements UpgradeWizardInterface
{
    public function getTitle(): string
    {
        return 'EXT:bootstrap_package_icons: Migrate old iconpack data from beta version to new fields';
    }

    public function getDescription(): string
    {
        return 'Count of affected groups: ' . $this->countMigrationRecords();
    }

    public function getIdentifier(): string
    {
        return 'bootstrapPackageIconpack_migrateFromBeta';
    }
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    public function updateNecessary(): bool
    {
        return $this->checkIfWizardIsRequired();
    }

    public function executeUpdate(): bool
    {
        return $this->performMigration();
    }

    public function checkIfWizardIsRequired(): bool
    {
        return $this->countMigrationRecords() > 0;
    }

    public function performMigration(): bool
    {
        $table = 'tx_bootstrappackage_accordion_item';
        $records = $this->getMigrationRecords($table);
        foreach ($records as $record) {
            $this->updateRow($table, $record);
        }

        $table = 'tx_bootstrappackage_tab_item';
        $records = $this->getMigrationRecords($table);
        foreach ($records as $record) {
            $this->updateRow($table, $record);
        }

        return true;
    }

    private function countMigrationRecords(): int
    {
        $count = count($this->getMigrationRecords('tx_bootstrappackage_accordion_item'));
        $count += count($this->getMigrationRecords('tx_bootstrappackage_tab_item'));
        return $count;
    }

    private function getMigrationRecords(string $table): array
    {
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable($table);
        $queryBuilder->getRestrictions()->removeAll();
        $query = $queryBuilder
            ->select('uid', 'iconpack')
            ->from($table)
            ->where(
                $queryBuilder->expr()->eq(
                    'header_icon',
                    $queryBuilder->createNamedParameter('', Connection::PARAM_STR)
                ),
                $queryBuilder->expr()->neq(
                    'iconpack',
                    $queryBuilder->createNamedParameter('', Connection::PARAM_STR)
                )
            );
        if (version_compare(VersionNumberUtility::getCurrentTypo3Version(), '11', '<')) {
            /** @disregard P1013 Undefined method */
            // @extensionScannerIgnoreLine
            return $query->execute()->fetchAllAssociativeIndexed();
        } else {
            return $query->executeQuery()->fetchAllAssociative();
        }
    }

    protected function updateRow(string $table, array $row): void
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $query = $queryBuilder->update($table)
            ->set('header_icon', $row['iconpack'])
            ->where(
                $queryBuilder->expr()->eq(
                    'header_icon',
                    $queryBuilder->createNamedParameter('', Connection::PARAM_STR)
                ),
                $queryBuilder->expr()->neq(
                    'iconpack',
                    $queryBuilder->createNamedParameter('', Connection::PARAM_STR)
                )
            );
        if (version_compare(VersionNumberUtility::getCurrentTypo3Version(), '11', '<')) {
            /** @disregard P1013 Undefined method */
            // @extensionScannerIgnoreLine
            $query->execute();
        } else {
            $query->executeStatement();
        }
    }
}
