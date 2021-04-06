<?php

namespace App\Rest\Transport;

use App\Rest\Response;
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
    private string $uri;
    private array $headers = [];
    private array $data = [];

    public function __construct()
    {
        $this->server = [
            'baseUrl' => SimpleDotEnv::getVar('BASE_URL'),
        ];

        $this->auth['username'] = SimpleDotEnv::getVar('USERNAME');
        $this->auth['password'] = SimpleDotEnv::getVar('PASSWORD');
    }

    public function get(string $url): Response
    {
        $this->prepare($url);

        return $this->curlItWith('GET');
    }

    public function post(string $url, ?array $data = []): Response
    {
        $this->prepare($url, $data);

        return $this->curlItWith('POST');
    }

    private function curlItWith(string $method): Response
    {
        $ch = curl_init($this->uri);
        curl_setopt($ch, CURLOPT_URL, $this->uri);

        if($method === 'POST') {
            //only POST
            curl_setopt($ch, CURLOPT_POST, true);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = $this->buildHeaders();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if($method === 'POST') {
            $data = $this->buildData();
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        //for debug in case of emergency
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);

        curl_close($ch);

        return $this->parseResponse($response, $info);
    }

    private function parseResponse(bool|string $response, array $info): Response
    {
        if(isset($this->headers['Accept']) && $this->headers['Accept'] === 'application/json') {
            $result = new Response(json_decode($response, true), $info);
        } else {
            $result = new Response($response, $info) ?? [];
        }

        return $result;
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

    private function buildUri(string $url): string
    {
        if(!isset($this->server['baseUrl'])) {
            throw new \RuntimeException('Server is not configured!');
        }

        return sprintf('%s%s', $this->server['baseUrl'], $url);
    }

    private function buildHeaders(): array
    {
        $headers = [];
        foreach($this->headers as $name => $value) {
            $headers[] = sprintf('%s: %s', $name, $value);
        }

        return $headers;
    }

    private function buildData(): string
    {
        return json_encode($this->data);
    }

    private function prepare(string $url, ?array $data = null): void
    {
        $this->uri = $this->buildUri($url);

        $this->headers = [
            'Accept' => 'application/json', //TODO: parameterize, if there is a choice someday
            'Authorization' => sprintf(
                "Basic %s",
                base64_encode(sprintf("%s:%s",
                    $this->auth['username'],
                    $this->auth['password'],
                ))
            ),
            'Content-Type' => 'application/json', //TODO: parameterize, if there is a choice someday
        ];

        //only POST
        if($data !== null) {
            $this->data = $data;
        }
    }
}
