<?php

namespace App\Controller;


use App\Rest\Client;
use App\Rest\Response;
use App\Rest\ResponseInterface;
use HttpRequestException;

abstract class ControllerAbstract
{
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
