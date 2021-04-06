<?php

namespace spec\App\Rest\Transport;

use App\Rest\Transport\Curl;
use PhpSpec\ObjectBehavior;

class CurlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Curl::class);
    }
}
