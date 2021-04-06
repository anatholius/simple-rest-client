<?php

namespace spec\App\Controller;

use App\Controller\ApiController;
use PhpSpec\ObjectBehavior;

class ApiControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ApiController::class);
    }
}
