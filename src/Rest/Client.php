<?php

namespace App\Rest;

use App\Rest\Transport\Curl;

/**
 * @property Curl transport
 */
class Client
{
    public function __construct(string $transportName = 'curl')
    {
        // try..catch is for avoiding annoying underlines in PhpStorm
        try {
            // `PHP 8` semantics for catch in `7.4`
            $this->transport = match ($transportName) {
                'curl' => new Curl(),
                default => throw new \Exception('Unknown transport type')
            };
        } catch(\Exception $exception) {
            var_dump($exception);
            die();
        }
    }

    public function get(string $url): array
    {
        return $this->transport->get($url);
    }

    public function post(string $url, array $params): array
    {
        return $this->transport->post($url, $params);
    }
}
