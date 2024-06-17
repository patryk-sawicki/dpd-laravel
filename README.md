# DPD PL API Client

DPD PL API client for laravel.

## Requirements

* PHP 8.2 or higher with json extensions.

## Installation

The recommended way to install is through [Composer](http://getcomposer.org).

```bash
composer require patryk-sawicki/dpd-laravel
```

## Backend Usage

Add to env:

```php
DPD_LOGIN = 'your_login'
DPD_API_KEY = 'your_password'
DPD_MASTER_FID = 'your_master_fid'
DPD_SANDBOX = false // optional - default false
DPD_CACHE_DEFAULT_TTL = 86400 // optional - default 86400 seconds
DPD_OUTPUT_DOC_FORMAT_V1 = 'PDF' // optional - default PDF
DPD_OUTPUT_DOC_PAGE_FORMAT_V1 = 'LBL_PRINTER' // optional - default LBL_PRINTER
DPD_OUTPUT_LABEL_TYPE_V1 = 'BIC3' // optional - default BIC3
```

Import class:

```php
use PatrykSawicki\DpdApi\app\Classes\Dpd;
```

### Generate Waybill Label

Generate waybill label.

```php
Dpd::generateWaybillLabel()->generate(array $data); // return ?
```

Request:

```php
[
            'openUMLFeV11' => [
                'packages' => [
                    'parcels' => [
                        'weight' => 20, //in kilograms
                        //'weightAdr' => 20, //in kilograms
                        'sizeX' => 10, //in centimeters
                        'sizeY' => 20, //in centimeters
                        'sizeZ' => 30, //in centimeters
                        'content' => 'Some content',
                        'customerData1' => 'parcel ref11',
                        'customerData2' => 'parcel ref33',
                        'customerData3' => 'parcel ref33',
                    ],
                    'payerType' => 'THIRD_PARTY',
                    'thirdPartyFID' => 1495,
                    'receiver' => [
                        'name' => 'John Doe',
                        //'address' => 'Testowa 1',
                        //'city' => 'Warszawa',
                        //'postalCode' => '99418',
                        'countryCode' => 'PL',
                        'phone' => '123456789',
                        'email' => 'pan@chcepaczke.pl',
                    ],
                    'sender' => [
                        'company' => 'qw',
                        'name' => 'John Doe',
                        'address' => 'Testowa 1',
                        'city' => 'Warszawa',
                        'postalCode' => '01234',
                        'countryCode' => 'PL',
                        'phone' => '123456789',
                        'email' => 'pan@chcepaczke.pl',
                    ],
                    'ref1' => 'cos tam 1',
                    'ref2' => 'cos tam 2',
                    'ref3' => 'cos tam 3',
                    'services' => [
                        //'dpdLQ' => null,
                        //'rod' => null,
                        //'carryIn' => null,
                        /*'declaredValue' => [
                            'amount' => 100,
                            'currency' => 'PLN',
                        ],*/
                        'dpdPickup' => [
                            'pudo' => 'PL14187',
                        ],
                    ],
                ],
            ],
            'pkgNumsGenerationPolicyV1' => 'ALL_OR_NOTHING',
            'langCode' => 'PL',
        ];
```

Result:

```php
[
  "Status" => "OK"
  "SessionId" => "238285549"
  "Packages" => [
    "Package" => [
      "Status" => "OK"
      "PackageId" => "220959048"
      "Parcels" => [
        "Parcel" => [
          "Status" => "OK"
          "ParcelId" => "248680600"
          "Waybill" => "0000003466547Q"
        ]
      ]
    ]
  ]
]
```

### Generate Shipping Label

Generate label for shipping.

```php
Dpd::generateShippingLabel()->pdf(array $data); // return ?
```

Request:

```php
[
            'dpdServicesParamsV1' => [
                'policy' => 'STOP_ON_FIRST_ERROR',
                'session' => [
                    'packages' => [
                        'parcels' => [
                            'waybill' => '0000003466547Q',
                        ],
                    ],
                    'sessionType' => 'DOMESTIC',
                ],
            ],
            'outputDocFormatV1' => 'PDF', // ZPL
            'outputDocPageFormatV1' => 'LBL_PRINTER',
            'outputLabelType' => 'BIC3',
        ]
```

Result:

```php
[
  "documentData" => "JVBERi0xLjQKJeLjz9MKMiAwIG9iag..."
  "session" => [
    "packages" => [
      "parcels" => [
        "statusInfo" => [
          "status" => "OK"
        ]
        "waybill" => "0000003466551Q"
      ]
      "statusInfo" => [
        "status" => "OK"
      ]
    ]
    "statusInfo" => [
      "status" => "OK"
    ]
  ]
]
```

### Labels panel

Add a panel for generating labels.

```php
<x-dpd::labels-panel
    :weight=""
    :sizeX=""
    :sizeY=""
    :sizeZ=""
    :destination-code=""
    :receiverName=""
    :receiverAddress=""
    :receiverCity=""
    :receiverPostCode=""
    :receiverPhone=""
    :receiverEmail=""
    :senderName=""
    :senderEmail=""
    :senderAddress=""
    :senderCity=""
    :senderPostCode=""
    :senderPhone=""
    :disc=""
    :dir=""
    :file=""
/>
```

## Changelog

Changelog is available [here](CHANGELOG.md).
