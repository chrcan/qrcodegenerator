<?php

declare(strict_types=1);

/*
 * (c) 2026 rc design visual concepts (rc-design.at)
 * _________________________________________________
 * The TYPO3 project - inspiring people to share!
 * _________________________________________________
 */

defined('TYPO3') || die();

use Rcdesign\QrCodeGenerator\Preview\QrCodePreviewRenderer;

call_user_func(function (): void {

    // PreviewRenderer für Backend
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1567890123] = [
        'nodeName' => 'qrcodePreviewRenderer',
        'priority' => 40,
        'class' => QrCodePreviewRenderer::class,
    ];

    // Falls PreviewRenderer für tt_content
    $GLOBALS['TCA']['tt_content']['types']['qrcodegenerator_pi1']['previewRenderer'] = QrCodePreviewRenderer::class;
});
