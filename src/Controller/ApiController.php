<?php

namespace App\Controller;

use App\Rest\Client;
use App\Rest\Response;

class ApiController
{
    public function getAll(): Response
    {
        $client = new Client();
        $client->setTransport('curl');

        // TODO: write logic here

        $response = new Response();

        // TODO: do what you need with $response

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
