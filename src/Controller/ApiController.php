<?php

namespace App\Controller;

use App\Rest\Client;
use App\Rest\Response;
use App\Rest\ResponseInterface;
use App\SimpleDotEnv;
use HttpRequestException;

class ApiController
{
    /**
     * @return ResponseInterface
     * @throws HttpRequestException
     */
    public function getAll(): ResponseInterface
    {
        $routePath = SimpleDotEnv::getVar('GET_ALL_URL');

        return $this->restResponse($routePath, 'GET');
    }

    /**
     * @param array|null $postData
     *
     * @return ResponseInterface
     * @throws HttpRequestException
     */
    public function createOne(?array $postData = []): ResponseInterface
    {
        $routePath = SimpleDotEnv::getVar('CREATE_ONE_URL');

        return $this->restResponse($routePath, 'POST', $postData);
    }

    /**
     * @param string     $routePath
     * @param string     $method
     * @param array|null $postData
     *
     * @return ResponseInterface
     * @throws HttpRequestException
     */
    protected function restResponse(string $routePath, string $method, ?array $postData = []): ResponseInterface
    {
        $client = new Client();

        $result = match ($method) {
            'GET' => $client->get($routePath),
            'POST' => $client->post($routePath, $postData),
            default => throw new HttpRequestException(sprintf('Nie obsługiwana metoda: %s', $method))
        };

        if($result instanceof ResponseInterface) {
            $response = $result;
        } else {
            $response = new Response($result);
        }

        return $response;
    }
}
