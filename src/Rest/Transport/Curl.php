<?php

namespace App\Rest\Transport;

class Curl implements TransportInterface
{
    const BASE_URL = 'http://localhost';

    public function get(string $url): array
    {
        $uri = sprintf('%s%s', self::BASE_URL, $url);

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type' => 'application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true) ?? [];
    }
}
