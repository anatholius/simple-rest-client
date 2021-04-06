<?php

namespace spec\App\Rest;

use App\Rest\Client;
use App\SimpleDotEnv;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function it_should_throw_when_GET_not_prepared_request()
    {
        $this->shouldThrow()->duringGet();
    }

    function it_allows_to_GET_request()
    {
        $url = SimpleDotEnv::getVar('GET_ALL_URL');
        $this->get($url)->shouldBeArray();
    }

    function it_should_not_throw_when_GET_prepared_request()
    {
        $this->prepareRequest();
        $getUrl = SimpleDotEnv::getVar('GET_ALL_URL');

        $this->shouldNotThrow()->duringGet($getUrl);
    }

    function it_allows_to_POST_request()
    {
        $url = SimpleDotEnv::getVar('CREATE_ONE_URL');
        $params = ['prop1' => 'value`'];
        $this->post($url, $params)->shouldBeArray();
    }
}
