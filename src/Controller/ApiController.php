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

        $response = new Response();

        // TODO: write logic here

        return $response;
    }
}
