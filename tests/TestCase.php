<?php

namespace PatrykSawicki\DpdTests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        /*Add config from /src/config*/
        $this->app['config']->set('dpd', require __DIR__ . '/../src/config/dpd.php');
    }

    protected static function waybillData(): array
    {
        return [
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
    }
}