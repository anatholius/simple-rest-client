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

        $response = $this->curlIt($url);

        return json_decode($response, true) ?? [];
    }

    public function post(string $url, ?array $data = []): array
    {
        $this->checkConfiguration();

        $uri = $this->buildUri($url);

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_URL, $uri);

        //only POST
        curl_setopt($ch, CURLOPT_POST, true);
        //TODO: move it to `curlIt`

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
        //TODO: move it to `curlIt`

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true) ?? [];
    }

    private function curlIt(string $url): bool|string
    {
        $uri = $this->buildUri($url);

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type' => 'application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
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

                $this->curlIt($url);
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
