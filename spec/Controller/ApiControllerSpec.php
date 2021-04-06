<?php

namespace spec\App\Controller;

use App\Controller\ApiController;
use App\Rest\Response;
use App\Rest\ResponseInterface;
use PhpSpec\ObjectBehavior;

class ApiControllerSpec extends ObjectBehavior
{
    public function getMatchers(): array
    {
        return [
            'beSuccess' => function(ResponseInterface $response) {
                return $response->getResult()['success'];
            },
        ];
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ApiController::class);
    }

    function it_should_allow_to_GetAll()
    {
        $this->getAll()->shouldReturnAnInstanceOf(Response::class);
    }

    function it_should_allow_to_CreateOne()
    {
        $this->createOne()->shouldReturnAnInstanceOf(Response::class);
    }

    function it_should_allow_to_CreateOne_with_success()
    {
        $postData = [
            'producer' => [
                "id" => rand(500, 999),
                "name" => "some name",
                "site_url" => null,
                "logo_filename" => "svg.file",
                "ordering" => "123",
                "source_id" => null,
            ],
        ];
        $response = $this->createOne($postData);
        $response->shouldReturnAnInstanceOf(ResponseInterface::class);
        $response->shouldBeSuccess();
    }

    function it_should_allow_to_CreateOne_with_error()
    {
        $postData = [
            'producer' => [
                "id" => 500,
                "name" => "some name",
                "site_url" => null,
                "logo_filename" => "svg.file",
                "ordering" => "123",
                "source_id" => null,
            ],
        ];
        $response = $this->createOne($postData);
        $response->shouldReturnAnInstanceOf(ResponseInterface::class);
        $response->shouldNotBeSuccess();
    }
}
