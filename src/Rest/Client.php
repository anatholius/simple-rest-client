<?php

namespace App\Rest;

use App\Rest\Transport\Curl;
use App\SimpleDotEnv;

/**
 * @property Curl transport
 */
class Client
{
    public function __construct(string $transportName = 'curl')
    {
        $this->setTransport($transportName);
    }

    public function get(string $url): Response
    {
        $this->checkConfiguration();

        return $this->transport->get($url);
    }

    public function post(string $url, array $params): Response
    {
        $this->checkConfiguration();

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

    private function checkConfiguration()
    {
        $curl = new Curl();
        if($curl->isConfigured()) {
            $curl->get(SimpleDotEnv::getVar('GET_ALL_URL'));
        } else {
            throw new \Exception('Server is not configured');
        }
    }

    public function prepareRequest(): void
    {
    }
}
