<?php

namespace App\Rest\Transport;

use App\SimpleDotEnv;
use JetBrains\PhpStorm\Pure;

/**
 * @property string[] server
 */
class Curl implements TransportInterface
{
    private array $auth = [
        'username' => null,
        'password' => null,
    ];

    public function __construct()
    {
        $this->server = [
            'baseUrl' => SimpleDotEnv::getVar('BASE_URL'),
        ];

        $this->auth['username'] = 'username';
        $this->auth['password'] = 'password';
    }

    public function get(string $url): array
    {
        $this->checkConfiguration();

        return $this->curlIt($url, 'GET');
    }

    public function post(string $url, ?array $data = []): array
    {
        $this->checkConfiguration();

        return $this->curlIt($url, 'POST', $data);
    }

    private function curlIt(string $url, string $method, ?array $data = []): array
    {
        $uri = $this->buildUri($url);

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_URL, $uri);

        if($method === 'POST') {
            //only POST
            curl_setopt($ch, CURLOPT_POST, true);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type' => 'application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if($method === 'POST') {
            //only POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        //for debug in case of emergency
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

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

    private function checkConfiguration(): void
    {
        // try..catch is for avoiding annoying underlines in PhpStorm
        try {
            // checking if we can send request using defined transport
            if($this->isConfigured()) {
                // there's tested GET method - just if it's working
                $url = SimpleDotEnv::getVar('GET_ALL_URL');

                $this->curlIt($url, 'GET');
                //if there is no exceptions -> everything is okay 🙂
            } else {
                throw new \Exception('Server is not configured');
            }
        } catch(\Exception $exception) {
            var_dump($exception);
            die();
        }
    }

    #[Pure]
    private function buildUri(string $url): string
    {
        return sprintf('%s%s', $this->server['baseUrl'], $url);
    }
}
