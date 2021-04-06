<?php

namespace App\Controller;

use App\Rest\ResponseInterface;
use App\SimpleDotEnv;

class ApiController extends ControllerAbstract
{
    public function getAll(): ResponseInterface
    {
        $routePath = SimpleDotEnv::getVar('GET_ALL_URL');

        try {
            return $this->restResponse($routePath, 'GET');
        } catch(\HttpRequestException $exception) {
            /**
             * (i) If there is nothing like 500`s here we can prepare
             *     other type of `Response` which implements ResponseInterface.
             *
             *     Otherwise, it can be just handled anything, what happened.     *
             */

            // PHP anonymous class was introduced in PHP 7
            return new class implements ResponseInterface {
            };
        }
    }

    public function createOne(?array $postData = []): ResponseInterface
    {
        $routePath = SimpleDotEnv::getVar('CREATE_ONE_URL');

        return $this->restResponse($routePath, 'POST', $postData);
    }
}
