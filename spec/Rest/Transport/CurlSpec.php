<?php

namespace spec\App\Rest\Transport;

use App\Rest\Response;
use App\Rest\Transport\Curl;
use App\Rest\Transport\TransportInterface;
use App\SimpleDotEnv;
use PhpSpec\ObjectBehavior;

class CurlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Curl::class);
        $this->shouldBeAnInstanceOf(TransportInterface::class);
    }

    function it_should_allow_to_send_GET_request()
    {
        $url = SimpleDotEnv::getVar('GET_ALL_URL');
        $this->get($url)->shouldBeAnInstanceOf(Response::class);
    }

    function it_should_allow_to_send_post_request()
    {
        $url = SimpleDotEnv::getVar('CREATE_ONE_URL');
        $this->post($url)->shouldBeAnInstanceOf(Response::class);
    }

    function it_should_allow_to_check_server_configuration()
    {
        $this->isConfigured()->shouldBe(true);
    }
}
