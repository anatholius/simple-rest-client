<?php

namespace App\Rest\Transport;

use JetBrains\PhpStorm\Pure;

/**
 * @property string[] server
 */
class Curl implements TransportInterface
{
    const BASE_URL = 'http://localhost';
    private array $auth = [
        'username' => null,
        'password' => null,
    ];

    public function __construct()
    {
        $this->server = [
            'baseUrl' => self::BASE_URL,
        ];

        $this->auth['username'] = 'username';
        $this->auth['password'] = 'password';
    }

    public function get(string $url): array
    {
        $uri = sprintf('%s%s', self::BASE_URL, $url);

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type' => 'application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true) ?? [];
    }

    public function post(string $url, ?array $data = []): array
    {
        $uri = sprintf('%s%s', self::BASE_URL, $url);

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_URL, $uri);

        //only POST
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type' => 'application/json',

            //fake Basic Auth
            'Authorization' => sprintf(
                "Basic %s",
                base64_encode(sprintf("%s:%s",
                    'username',
                    'password',
                ))
            ),
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //only POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true) ?? [];
    }

    #[Pure]
    public function isConfigured(): bool
    {
        return property_exists($this, 'server')
            && is_array($this->server)
            && isset($this->server['baseUrl'])
            && is_string($this->server['baseUrl'])
            && property_exists($this, 'auth')
            && is_array($this->auth)
            && isset($this->auth['username'])
            && $this->auth['username'] !== null
            && isset($this->auth['password'])
            && $this->auth['password'] !== null;
    }
}
