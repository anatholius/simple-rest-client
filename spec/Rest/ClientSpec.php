<?php

namespace spec\App\Rest;

use App\Rest\Client;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function it_should_allow_to_GET_request()
    {
        $url = '/api/endpoint';
        $this->get($url)->shouldBeArray();
    }
}
