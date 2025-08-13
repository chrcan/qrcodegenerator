# QR Code Generator – TYPO3 Extension

## Übersicht

Die Extension **`qrcodegenerator`** ermöglicht das einfache Erstellen und Einbinden von QR-Codes in TYPO3-Inhalten.  
Unterstützt werden sowohl einfache Text-QR-Codes als auch komplexere Codes, z. B. SEPA-Zahlungsinformationen für Telebanking.

---

## Features

- QR-Code-Generierung direkt im Frontend-Content-Element  
- Unterstützung mehrerer QR-Code-Typen (z. B. Text, SEPA-Zahlung)  
- Flexible Konfiguration über Backend-Felder  
- Vorschau im Backend mit automatisch generiertem QR-Code  
- Nutzung der [endroid/qr-code](https://github.com/endroid/qr-code) Library für die QR-Code-Erstellung  
- Einfache Integration mit Fluid Templates und Extbase Controller  

---

## Installation

### Über Composer
```bash
composer require rcdesign/qrcodegenerator
```
Anschließend die Extension im TYPO3-Backend aktivieren.

### Manuell über Extension Manager
1. ZIP-Datei hochladen oder aus TER installieren  
2. Extension im Backend aktivieren  

---

## Verwendung

1. Neues Inhaltselement **„QR Code Generator“** anlegen  
2. QR-Code-Typ auswählen (Text oder SEPA)  
3. Entsprechende Felder ausfüllen  
4. Im Frontend prüfen – der QR-Code wird automatisch generiert  

---

## Konfiguration

| Feldname          | Beschreibung                      | Pflichtfeld | Bemerkung                                  |
|-------------------|-----------------------------------|-------------|---------------------------------------------|
| `qrcode_type`     | QR-Code-Typ (Text, SEPA etc.)     | Ja          | Steuert die Art der QR-Codierung            |
| `qrcode_text`     | Text für einfachen QR-Code        | Ja (bei Text) | Nur bei Typ „Text“ relevant                 |
| `qrcode_iban`     | IBAN für SEPA-Zahlung             | Ja (bei SEPA) | Pflicht für SEPA-Zahlung                    |
| `qrcode_recipient`| Zahlungsempfänger                 | Ja (bei SEPA) | Pflicht für SEPA-Zahlung                    |
| `qrcode_amount`   | Betrag (EUR)                      | Ja (bei SEPA) | Pflicht für SEPA-Zahlung                    |
| `qrcode_purpose`  | Verwendungszweck                  | Nein         | Optional bei SEPA-Zahlung                   |

---

## Entwicklung

- Basiert auf **TYPO3 v13**, **Extbase** und **Fluid**  
- QR-Code-Erzeugung über eigenen `QrCodeService`  
- Nutzung der Library [endroid/qr-code](https://github.com/endroid/qr-code)  

---

## Changelog

**1.0.0**
- Initiale Version mit Text- und SEPA-QR-Code-Unterstützung  
- Backend-Preview mit QR-Code-Vorschau  
- Extbase Controller und DataProcessor für flexible Verarbeitung  

---

## Lizenz

Diese Extension ist unter der **MIT-Lizenz** veröffentlicht.  
Siehe [LICENSE](LICENSE) für weitere Informationen.

---

## Support & Kontakt

- GitHub: [rcdesign/qrcodegenerator](https://github.com/rcdesign/qrcodegenerator)  
- E-Mail: [werbegrafik@rc-design.at](mailto:werbegrafik@rc-design.at)  

---

> Viel Spaß beim Einsatz der Extension! 🚀
