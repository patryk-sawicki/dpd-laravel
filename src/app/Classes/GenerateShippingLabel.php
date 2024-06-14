<?php

namespace PatrykSawicki\DpdApi\app\Classes;

class GenerateShippingLabel extends Api
{
    /**
     * Get the list of items.
     * @param array $data
     * @return array
     */
    public function generate(array $data): array
    {
        $response = $this->postData('generateSpedLabelsV4', $data);

        if (empty($response)) {
            abort(500, 'Error while finding postal code');
        }

        return $response;
    }
}