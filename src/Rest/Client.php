<?php

namespace App\Rest;

use App\Rest\Transport\Curl;

class Client
{
    public function get(string $url): array
    {
        $curl = new Curl();

        return $curl->get($url);
    }

    public function post(string $url, array $params): array
    {
        $curl = new Curl();

        return $curl->post($url, $params);
    }
}
