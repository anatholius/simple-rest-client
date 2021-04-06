<?php

namespace spec\App\Rest\Transport;

use App\Rest\Transport\Curl;
use App\Rest\Transport\TransportInterface;
use PhpSpec\ObjectBehavior;

class CurlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Curl::class);
        $this->shouldBeAnInstanceOf(TransportInterface::class);
    }
}
