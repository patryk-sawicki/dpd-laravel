<?php

namespace PatrykSawicki\DpdApi\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PatrykSawicki\DpdApi\app\Classes\Dpd;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DpdController extends Controller
{
    /**
     * @param Request $request
     * @param string $disc
     * @param string $dir
     * @param string $file
     * @return StreamedResponse
     * @throws Exception
     */
    public function generateShippingLabel(
        Request $request,
        string $disc = 'public',
        string $dir = 'labels',
        string $file = 'label'
    ) {
        $dpd = new Dpd();

        $waybillInput['openUMLFeV11']['packages'] = $request->dpd;
        $waybillInput['openUMLFeV11']['packages']['payerType'] = 'THIRD_PARTY';
        $waybillInput['openUMLFeV11']['packages']['thirdPartyFID'] = config('dpd.api_master_fid');
        $waybillInput['openUMLFeV11']['packages']['receiver']['countryCode'] = 'PL';
        $waybillInput['openUMLFeV11']['packages']['sender']['countryCode'] = 'PL';
        $waybillInput['pkgNumsGenerationPolicyV1'] = 'ALL_OR_NOTHING';
        $waybillInput['langCode'] = 'PL';

        $this->removeEmptyData($waybillInput);

        if (isset($waybillInput['openUMLFeV11']['packages']['receiver']['postalCode'])) {
            $waybillInput['openUMLFeV11']['packages']['receiver']['postalCode'] = str_replace(
                '-',
                '',
                $waybillInput['openUMLFeV11']['packages']['receiver']['postalCode']
            );
        }

        $waybill = $dpd->generateWaybillLabel()->generate($waybillInput);

        if ($waybill['Status'] !== 'OK') {
            throw new Exception('Error while generating waybill label: ' . $waybill['Status']);
        }

        $waybillId = $waybill['Packages']['Package']['Parcels']['Parcel']['Waybill'];

        $result = $dpd->generateShippingLabel()->generate([
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
            'outputDocFormatV1' => config('dpd.output_doc_format_v1'), // ZPL
            'outputDocPageFormatV1' => config('dpd.output_doc_page_format_v1'),
            'outputLabelType' => config('dpd.output_label_type'),
        ]);

        if ($result['session']['statusInfo']['status'] !== 'OK') {
            throw new Exception(
                'Error while generating shipping label: ' . $result['session']['statusInfo']['status']
            );
        }

        $pdf = base64_decode($result['documentData']);

        Storage::disk($disc)->put($dir . '/' . $file . '.pdf', $pdf);
        return Storage::disk($disc)->download($dir . '/' . $file . '.pdf');
    }

    public function removeEmptyData(array &$data)
    {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $this->removeEmptyData($value);
            }

            if (empty($value)) {
                unset($data[$key]);
            }
        }
    }
}
