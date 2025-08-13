<?php

declare(strict_types=1);

/*
 * (c) 2025 rc design visual concepts (rc-design.at)
 * _________________________________________________
 * The TYPO3 project - inspiring people to share!
 * _________________________________________________
 */

namespace Rcdesign\QrCodeGenerator\Preview;

use Rcdesign\QrCodeGenerator\Service\QrCodeService;
use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
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
        $uri = $this->qrCodeService->generateDataUri($record['qrcode_text'] ?? '', 150);

        return $uri ? '<img src="' . $uri . '" alt="QR Code" style="max-width:150px;height:auto;">'
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
        return $item->getTable() === 'tt_content'
            && ($item->getRecord()['CType'] ?? '') === 'qrcodegenerator_pi1';
    }
}
