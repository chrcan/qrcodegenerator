<?php

declare(strict_types=1);

/*
 * (c) 2026 rc design visual concepts (rc-design.at)
 * _________________________________________________
 * The TYPO3 project - inspiring people to share!
 * _________________________________________________
 */

namespace Rcdesign\QrCodeGenerator\Preview;

use Rcdesign\QrCodeGenerator\Service\QrCodeService;
use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Core\Domain\Record;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class QrCodePreviewRenderer implements PreviewRendererInterface
{
    protected QrCodeService $qrCodeService;

    public function __construct()
    {
        $this->qrCodeService = GeneralUtility::makeInstance(QrCodeService::class);
    }

    public function renderPageModulePreviewHeader(GridColumnItem $item): string
    {
        return '';
    }

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $record = $item->getRecord();
        // WICHTIG: getRecord() gibt nun ein Record-Objekt zurück, kein Array
        $qrCodeText = '';
        if ($record instanceof Record) {
            // Zugriff auf Felder über die get() Methode des Record-Objekts
            $qrCodeText = (string)($record->get('qrcode_text') ?? '');
        }

        $uri = $this->qrCodeService->generateDataUri($qrCodeText, 150);

        return $uri !== '' && $uri !== '0'
            ? '<img src="' . htmlspecialchars($uri) . '" alt="QR Code" style="max-width:150px;height:auto;">'
            : '<em>Bitte geben Sie einen Text für den QR-Code ein.</em>';
    }

    public function renderPageModulePreviewFooter(GridColumnItem $item): string
    {
        return '';
    }

    public function wrapPageModulePreview(string $previewHeader, string $previewContent, GridColumnItem $item): string
    {
        return '<div class="tx-qrcode-preview">' . $previewHeader . $previewContent . '</div>';
    }

    public function supports(GridColumnItem $item): bool
    {
        $record = $item->getRecord();
        if ($record instanceof Record) {
            return $item->getTable() === 'tt_content'
                && $record->get('CType') === 'qrcodegenerator_pi1';
        }
        return false;
    }
}
