<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeExternalService
{

    public function performRequest($method, $endpoint, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->base_uri
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $endpoint, ['form_params' => $formParams, 'headers' => $headers]);

        return $response->getBody()->getContents();
    }

}
