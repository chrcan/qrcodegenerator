<?php

declare(strict_types=1);

/*
 * (c) 2026 rc design visual concepts (rc-design.at)
 * _________________________________________________
 * The TYPO3 project - inspiring people to share!
 * _________________________________________________
 */

namespace Rcdesign\QrCodeGenerator\Updates;

use TYPO3\CMS\Core\Attribute\RowUpdater;
use TYPO3\CMS\Core\Upgrades\AbstractListTypeToCTypeUpdate;

#[RowUpdater('rcdesignQrCodeGeneratorCTypeMigration')]
final class RcdesignQrCodeGeneratorCTypeMigration extends AbstractListTypeToCTypeUpdate
{
    public function getTitle(): string
    {
        return 'Migrate "Rcdesign QrCodeGenerator" plugins to content elements.';
    }

    public function getDescription(): string
    {
        return 'The "Rcdesign QrCodeGenerator" plugins are now registered as content element. Update migrates existing records and backend user permissions.';
    }

    /**
     * @return array<string, string>
     */
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'qrcodegenerator_pi1' => 'qrcodegenerator_pi1',
        ];
    }
}
