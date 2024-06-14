<?php

namespace PatrykSawicki\DpdApi\app\Classes;

use GuzzleHttp\Client;
use PatrykSawicki\DpdApi\app\Traits\functions;

class Api
{
    use functions;

    protected string $apiLogin, $apiPassword, $apiMasterFid, $url;

    public function __construct()
    {
        $this->apiLogin = config('dpd.api_login');
        $this->apiPassword = config('dpd.api_password');
        $this->apiMasterFid = config('dpd.api_master_fid');
        $this->url = config('dpd.sandbox') ? config('dpd.sandbox_url') : config('dpd.api_url');
    }

    /*
     * Send data to API.
     * @param string $route
     * @param array $data
     * @return array
     * */
    protected function postData(string $endpoint, array $data = []): array
    {
        $data = $this->makeSoapData(endpoint: $endpoint, data: $this->addAuthData($data));

        /*Send soap data to url*/
        $client = new Client();
        $response = $client->request('POST', $this->url, [
            'headers' => $this->requestHeaders(),
            'body' => $data,
        ]);

        if ($response->getStatusCode() != 200) {
            abort(400, $response->getBody());
        }

        $content = $response->getBody()->getContents();

        $soap = simplexml_load_string($content);
        $response = $soap->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children(
            'http://dpdservices.dpd.com.pl/'
        )->children()->children();

        return json_decode(json_encode($response), true);
    }

    private function addAuthData(array $data): array
    {
        $data['authDataV1']['login'] = $this->apiLogin;
        $data['authDataV1']['masterFid'] = $this->apiMasterFid;
        $data['authDataV1']['password'] = $this->apiPassword;

        return $data;
    }

    private function makeSoapData(string $endpoint, array $data): string
    {
        $xml = new \SimpleXMLElement(
            '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"></soap:Envelope>'
        );

        $body = $xml->addChild('soap:Body');
        $child = $body->addChild('dpd:' . $endpoint, namespace: 'http://dpdservices.dpd.com.pl/');
        $this->addChildren($child, $data);

        $xml = str_replace("\n", '', $xml->asXML());

        /*Remove xmlns="%" from xml*/
        $xml = preg_replace('/xmlns="[^"]*"/', '', $xml);

        /*Return removing html tags*/
        return $xml;
    }

    private function addChildren(\SimpleXMLElement $xml, array $data): void
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->addChildren($xml->addChild($key, namespace: $key), $value);
            } else {
                $xml->addChild($key, $value, $key);
            }
        }
    }
}