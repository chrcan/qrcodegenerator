<?php

declare(strict_types=1);

/*
 * (c) 2025 rc design visual concepts (rc-design.at)
 * _________________________________________________
 * The TYPO3 project - inspiring people to share!
 * _________________________________________________
 */

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:tt_content.CType.qrcodegenerator',
        'qrcodegenerator_pi1',
        'tx-qrcodegenerator-svgicon',
    ],
    'CType',
    'qrcodegenerator'
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
                ['Text', 'text'],
                ['SEPA Zahlung', 'sepa'],
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
            'eval' => 'trim,required',
        ],
    ],
    'qrcode_amount' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:qrcode_amount',
        'displayCond' => 'FIELD:qrcode_type:=:sepa',
        'config' => [
            'type' => 'input',
            'eval' => 'trim,double2',
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
    --palette--;;general,
    qrcode_type,
    qrcode_text,
    qrcode_amount,
    qrcode_iban,
    qrcode_recipient,
    qrcode_purpose,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
    --palette--;;hidden,
    --palette--;;access,
';

$GLOBALS['TCA']['tt_content']['types']['qrcodegenerator_pi1']['previewRenderer']
    = Rcdesign\QrCodeGenerator\Preview\QrCodePreviewRenderer::class;

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['qrcodegenerator_pi1'] = 'tx-qrcodegenerator-svgicon';

// Wizard-Eintrag ergänzen für description
$GLOBALS['TCA']['tt_content']['ctrl']['descriptionColumn'] = 'description';

$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = [
    'label' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:tt_content.CType.qrcodegenerator',
    'value' => 'qrcodegenerator_pi1',
    'icon' => 'tx-qrcodegenerator-svgicon',
    'description' => 'LLL:EXT:qrcodegenerator/Resources/Private/Language/locallang_db.xlf:tt_content.CType.qrcodegenerator.description',
    'group' => 'plugins',
];
