<?php

namespace App\Controller;

use App\Rest\ResponseInterface;
use App\SimpleDotEnv;

class ApiController extends ControllerAbstract
{
    public function getAll(): ResponseInterface
    {
        $routePath = SimpleDotEnv::getVar('GET_ALL_URL');

        return $this->restResponse($routePath, 'GET');
    }

    public function createOne(?array $postData = []): ResponseInterface
    {
        $routePath = SimpleDotEnv::getVar('CREATE_ONE_URL');

        return $this->restResponse($routePath, 'POST', $postData);
    }
}
