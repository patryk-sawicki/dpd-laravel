<?php

namespace PatrykSawicki\DpdApi\app\Classes;

class GenerateWaybillLabel extends Api
{
    /**
     * Get the list of items.
     * @param array $data
     * @return array
     */
    public function generate(array $data): array
    {
        $response = $this->postData('generatePackagesNumbersV9', $data);

        if (!is_array($response) || empty($response)) {
            abort(500, 'Error while finding postal code');
        }

        return $response;
    }
}