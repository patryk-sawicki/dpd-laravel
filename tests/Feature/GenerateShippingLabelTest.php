<?php

namespace PatrykSawicki\DpdTests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PatrykSawicki\DpdApi\app\Classes\Dpd;
use PatrykSawicki\DpdTests\TestCase;

class GenerateShippingLabelTest extends TestCase
{
//    use DatabaseTransactions;

    public function testLoad()
    {
        $waybill = Dpd::generateWaybillLabel()->generate(self::waybillData());

        $this->assertTrue($waybill['Status'] === 'OK', 'Error while generating waybill label');

        $waybillId = $waybill['Packages']['Package']['Parcels']['Parcel']['Waybill'];

        $result = Dpd::generateShippingLabel()->generate([
            'dpdServicesParamsV1' => [
                'policy' => 'STOP_ON_FIRST_ERROR',
                'session' => [
                    'packages' => [
                        'parcels' => [
                            'waybill' => $waybillId,
                        ],
                    ],
                    'sessionType' => 'DOMESTIC',
                ],
            ],
            'outputDocFormatV1' => 'PDF', // ZPL
            'outputDocPageFormatV1' => 'LBL_PRINTER',
            'outputLabelType' => 'BIC3',
        ]);

        $this->assertTrue($result['session']['statusInfo']['status'] == 'OK', 'Error while generating shipping label');
    }
}
