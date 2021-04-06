<?php

namespace App\Rest;

use App\Rest\Transport\Curl;
use App\SimpleDotEnv;

/**
 * @property Curl transport
 */
class Client
{
    public function __construct()
    {
        $this->setTransport();
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
     * (i) We can set transport from outside this class, when we have more than only `cRUL`
     *
     * @param string|null $transportName - nazwa transportu (BTW `Strategy` design pattern)
     */
    public function setTransport(?string $transportName = null): void
    {
        $transportName = $transportName ?? SimpleDotEnv::getVar('TRANSPORT_NAME');

        // try..catch is for avoiding annoying underlines in PhpStorm
        try {
            switch($transportName) {
                case 'curl':
                    $this->transport = new Curl();
                    break;
                default:
                    throw new \Exception('Unknown transport type');
            }
        } catch(\Exception $exception) {
            dd($exception);
        }
    }

    private function checkConfiguration()
    {
        // try..catch is for avoiding annoying underlines in PhpStorm
        try {
            $curl = new Curl();
            if($curl->isConfigured()) {
                $curl->get(SimpleDotEnv::getVar('GET_ALL_URL'));
            } else {
                throw new \Exception('Server is not configured');
            }
        } catch(\Exception $exception) {
            dd($exception);
        }
    }

    public function prepareRequest(): void
    {
    }
}
