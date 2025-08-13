<?php

declare(strict_types=1);

/*
 * (c) 2025 rc design visual concepts (rc-design.at)
 * _________________________________________________
 * The TYPO3 project - inspiring people to share!
 * _________________________________________________
 */

namespace Rcdesign\QrCodeGenerator\DataProcessing;

use Rcdesign\QrCodeGenerator\Service\QrCodeService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class QrCodeDataProcessor implements DataProcessorInterface
{
    /**
     * @param ContentObjectRenderer $cObj
     * @param array                 $contentObjectConfiguration
     * @param array                 $processorConfiguration
     * @param array                 $processedData
     *
     * @return array
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $data = $processedData['data'] ?? [];

        $type = $data['qrcode_type'] ?? 'text';

        $qrText = '';

        switch ($type) {
            case 'sepa':
                $iban      = trim($data['qrcode_iban'] ?? '');
                $recipient = trim($data['qrcode_recipient'] ?? '');
                $amount    = trim($data['qrcode_amount'] ?? '');
                $purpose   = trim($data['qrcode_purpose'] ?? '');

                if ($iban !== '' && $recipient !== '' && $amount !== '') {
                    // Einfaches EPC QR Code Format (vereinfachtes Beispiel)
                    $qrText = "BCD\n002\n1\nSCT\n\n{$recipient}\n{$iban}\nEUR{$amount}\n{$purpose}";
                }
                break;

            case 'text':
            default:
                $qrText = trim($data['qrcode_text'] ?? '');
                break;
        }

        /** @var QrCodeService $qrCodeService */
        $qrCodeService = GeneralUtility::makeInstance(QrCodeService::class);

        $qrCodeUri = $qrText !== '' ? $qrCodeService->generateDataUri($qrText, 300) : null;

        $processedData['qrCodeUri'] = $qrCodeUri;
        $processedData['qrText'] = $qrText;

        return $processedData;
    }
}
