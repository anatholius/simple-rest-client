<?php

namespace App\Controller;

use App\Rest\Client;
use App\Rest\Response;
use App\Rest\ResponseInterface;
use App\SimpleDotEnv;

class ApiController
{
    public function getAll(): ResponseInterface
    {
        $transportName = 'curl';
        $client = new Client();
        $client->setTransport($transportName);

        $getAllUrl = SimpleDotEnv::getVar('GET_ALL_URL');
        $result = $client->get($getAllUrl);

        if($result instanceof ResponseInterface) {
            $response = $result;
        } else {
            $response = new Response($result);
        }

        return $response;
    }

    public function createOne(?array $postData = []): ResponseInterface
    {
        $transportName = 'curl';
        $client = new Client();
        $client->setTransport($transportName);

        $createOneUrl = SimpleDotEnv::getVar('CREATE_ONE_URL');
        $result = $client->post($createOneUrl, $postData);

        if($result instanceof ResponseInterface) {
            $response = $result;
        } else {
            $response = new Response($result);
        }

        return $response;
    }
}
