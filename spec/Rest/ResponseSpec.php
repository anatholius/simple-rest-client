<?php

namespace spec\App\Rest;

use App\Rest\Response;
use PhpSpec\ObjectBehavior;

class ResponseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Response::class);
    }
}
