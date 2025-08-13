<?php

declare(strict_types=1);

/*
 * (c) 2025 rc design visual concepts (rc-design.at)
 * _________________________________________________
 * The TYPO3 project - inspiring people to share!
 * _________________________________________________
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'QR Code Generator',
    'description' => 'Generiert einen QR-Code im Frontend und zeigt eine Backend-Vorschau.',
    'category' => 'plugin',
    'author' => 'Christian Racan',
    'author_email' => 'werbegrafik@rc-design.at',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0-13.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'icon' => 'EXT:qrcodegenerator/Resources/Public/Icons/Extension.svg',
];
