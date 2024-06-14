<?php

namespace PatrykSawicki\DpdTests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PatrykSawicki\DpdApi\app\Classes\Dpd;
use PatrykSawicki\DpdTests\TestCase;

class FindPostalCodeTest extends TestCase
{
//    use DatabaseTransactions;

    public function testLoad()
    {
        $result = Dpd::findPostalCode()->find([
            'postalCodeV1' => [
                'countryCode' => 'PL',
                'zipCode' => '16010',
            ],
        ]);

        $this->assertTrue($result, 'Error while finding postal code');
    }
}
