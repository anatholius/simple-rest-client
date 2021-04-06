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
        $client = new Client(SimpleDotEnv::getVar('TRANSPORT_NAME'));

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
        $client = new Client(SimpleDotEnv::getVar('TRANSPORT_NAME'));

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
