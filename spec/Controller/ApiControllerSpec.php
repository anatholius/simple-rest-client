<?php

namespace spec\App\Controller;

use App\Controller\ApiController;
use App\Rest\Response;
use PhpSpec\ObjectBehavior;

class ApiControllerSpec extends ObjectBehavior
{
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
}
