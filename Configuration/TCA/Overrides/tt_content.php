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
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Plugin registrieren - DAS IST AUSREICHEND
ExtensionManagementUtility::addPlugin(
    [
        'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:tt_content.CType.qrcodegenerator',
        'value' => 'qrcodegenerator_pi1',
        'icon' => 'tx-qrcodegenerator-svgicon',
        'description' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:tt_content.CType.qrcodegenerator.description',
    ],
    'CType',
    'qrcodegenerator'  // Extension-Name
);

// Neue Felder hinzufügen
$newColumns = [
    'qrcode_type' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:qrcode_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => 'Text', 'value' => 'text'],
                ['label' => 'SEPA Zahlung', 'value' => 'sepa'],
            ],
            'default' => 'text',
        ],
    ],
    'qrcode_text' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:qrcode_text',
        'displayCond' => 'FIELD:qrcode_type:=:text',
        'config' => [
            'type' => 'input',
            'size' => 50,
            'eval' => 'trim',
            'required' => true,
        ],
    ],
    'qrcode_amount' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:qrcode_amount',
        'displayCond' => 'FIELD:qrcode_type:=:sepa',
        'config' => [
            'type' => 'number',
            'eval' => 'trim',
            'format' => 'decimal',
        ],
    ],
    'qrcode_iban' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:qrcode_iban',
        'displayCond' => 'FIELD:qrcode_type:=:sepa',
        'config' => [
            'type' => 'input',
            'eval' => 'trim',
        ],
    ],
    'qrcode_recipient' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:qrcode_recipient',
        'displayCond' => 'FIELD:qrcode_type:=:sepa',
        'config' => [
            'type' => 'input',
            'eval' => 'trim',
        ],
    ],
    'qrcode_purpose' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:qrcode_purpose',
        'displayCond' => 'FIELD:qrcode_type:=:sepa',
        'config' => [
            'type' => 'input',
            'eval' => 'trim',
        ],
    ],
];

// Spalten hinzufügen
ExtensionManagementUtility::addTCAcolumns('tt_content', $newColumns);

// Felder in Showitem definieren
$GLOBALS['TCA']['tt_content']['types']['qrcodegenerator_pi1']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
    --palette--;;general,
    --palette--;;headers,
    qrcode_type,
    qrcode_text,
    qrcode_amount,
    qrcode_iban,
    qrcode_recipient,
    qrcode_purpose,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
    --palette--;;hidden,
    --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
    rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

$GLOBALS['TCA']['tt_content']['types']['qrcodegenerator_pi1']['previewRenderer']
    = QrCodePreviewRenderer::class;

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['qrcodegenerator_pi1'] = 'tx-qrcodegenerator-svgicon';
