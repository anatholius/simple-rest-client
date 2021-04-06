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
        $this->setTransport($transportName);
    }

    public function get(string $url): array
    {
        // checking if we can send request using defined transport
        if($this->transport->isConfigured()) {
            $this->transport->get('/api/real-endpoint');
            //if there is no exceptions -> everything is okay 🙂
            //TODO: but wait, we don't have `isConfigured()` function inside transport class
            //      ..well, BDD and spec 😀..
        } else {
            throw new \Exception('Server is not configured');
        }

        return $this->transport->get($url);
    }

    public function post(string $url, array $params): array
    {
        return $this->transport->post($url, $params);
    }

    /**
     * (i) We can set transport from outside this class, when we have more than `cRUL`
     *
     * @param string $transportName - nazwa transportu (BTW `Strategy` design pattern)
     */
    public function setTransport(string $transportName): void
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
}
