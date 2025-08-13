<?php

declare(strict_types=1);

/*
 * (c) 2025 rc design visual concepts (rc-design.at)
 * _________________________________________________
 * The TYPO3 project - inspiring people to share!
 * _________________________________________________
 */

defined('TYPO3') or die();

use Rcdesign\QrCodeGenerator\Controller\QrCodeController;
use Rcdesign\QrCodeGenerator\Preview\QrCodePreviewRenderer;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(function (): void {
    // Icon Registry
    $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
    $iconRegistry->registerIcon(
        'tx-qrcodegenerator-svgicon',
        SvgIconProvider::class,
        ['source' => 'EXT:qrcodegenerator/Resources/Public/Icons/Extension.svg']
    );
    // Plugin Registrierung
    ExtensionUtility::configurePlugin(
        'qrcodegenerator',
        'Pi1',
        [
            QrCodeController::class => 'show',
        ],
        // keine Cache-Actions für Frontend
        [],
        // keine Cache-Actions für Backend
        null
    );

    // PreviewRenderer für Backend
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1567890123] = [
        'nodeName' => 'qrcodePreviewRenderer',
        'priority' => 40,
        'class' => QrCodePreviewRenderer::class,
    ];

    // Falls PreviewRenderer für tt_content
    $GLOBALS['TCA']['tt_content']['types']['qrcodegenerator_pi1']['previewRenderer'] = QrCodePreviewRenderer::class;
});
