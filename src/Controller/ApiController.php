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
        $routePath = SimpleDotEnv::getVar('GET_ALL_URL');

        return $this->restResponse($routePath);
    }

    public function createOne(?array $postData = []): ResponseInterface
    {
        $client = new Client();

        $routePath = SimpleDotEnv::getVar('CREATE_ONE_URL');
        $result = $client->post($routePath, $postData);

        if($result instanceof ResponseInterface) {
            $response = $result;
        } else {
            $response = new Response($result);
        }

        return $response;
    }

    protected function restResponse($routePath): ResponseInterface
    {
        $client = new Client();

        $result = $client->get($routePath);

        if($result instanceof ResponseInterface) {
            $response = $result;
        } else {
            $response = new Response($result);
        }

        return $response;
    }
}
