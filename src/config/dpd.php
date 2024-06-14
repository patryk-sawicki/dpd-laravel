<?php

/*Configuration file for DPD API.*/
return [
    'api_login' => env('DPD_LOGIN', null),
    'api_password' => env('DPD_PASSWORD', null),
    'api_master_fid' => env('DPD_MASTER_FID', null),
    'api_url' => env(
        'DPD_API_URL',
        'https://dpdservices.dpd.com.pl/DPDPackageObjServicesService/DPDPackageObjServices?WSDL'
    ),
    'sandbox_url' => env(
        'DPD_SANDBOX_URL',
        'https://dpdservicesdemo.dpd.com.pl/DPDPackageObjServicesService/DPDPackageObjServices?WSDL'
    ),

    'sandbox' => boolval(env('DPD_SANDBOX', false)),

    /*Cache time*/
    'cache_time' => intval(env('DPD_CACHE_DEFAULT_TTL', 86400)),

    'output_doc_format_v1' => env('DPD_OUTPUT_DOC_FORMAT_V1', 'PDF'),
    'output_doc_page_format_v1' => env('DPD_OUTPUT_DOC_PAGE_FORMAT_V1', 'LBL_PRINTER'),
    'output_label_type' => env('DPD_OUTPUT_LABEL_TYPE', 'BIC3'),
];