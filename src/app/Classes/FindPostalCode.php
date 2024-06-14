<?php

namespace PatrykSawicki\DpdApi\app\Classes;

class FindPostalCode extends Api
{
    /**
     * Get the list of items.
     * @param array $data
     * @return bool
     */
    public function find(array $data): bool
    {
        $response = $this->postData('findPostalCodeV1', $data);

        if (empty($response)) {
            abort(500, 'Error while finding postal code');
        }

        return $response['status'] == 'OK';
    }
}