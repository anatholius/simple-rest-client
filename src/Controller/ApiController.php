<?php

namespace App\Controller;

use App\Rest\Client;
use App\Rest\Response;
use App\Rest\ResponseInterface;
use App\SimpleDotEnv;

class ApiController
{
    public function getAll(): Response
    {
        $client = new Client();
        $client->setTransport('curl');

        $getAllUrl = SimpleDotEnv::getVar('GET_ALL_URL');
        $result = $client->get($getAllUrl);

        if($result instanceof ResponseInterface) {
            $response = $result;
        } else {
            $response = new Response($result);
        }

        return $response;
    }

    public function createOne(): Response
    {
        $client = new Client();
        $client->setTransport('curl');

        // TODO: write logic here

        $response = new Response();

        // TODO: do what you need with $response

        return $response;
    }
}
