<?php

namespace PatrykSawicki\DpdTests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PatrykSawicki\DpdApi\app\Classes\Dpd;
use PatrykSawicki\DpdTests\TestCase;

class GenerateWaybillLabelTest extends TestCase
{
//    use DatabaseTransactions;

    public function testLoad()
    {
        $result = Dpd::generateWaybillLabel()->generate(self::waybillData());

        $this->assertTrue($result['Status'] === 'OK', 'Error while generating waybill label: ' . $result['Status']);
    }
}
