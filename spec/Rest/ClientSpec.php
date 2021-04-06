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

    function it_should_throw_when_get_not_prepared_request()
    {
        $this->shouldThrow()->duringGet();
    }

    function it_should_allow_to_GET_request()
    {
        $url = sprintf('%s%s',
            SimpleDotEnv::getVar('BASE_URL'),
            SimpleDotEnv::getVar('GET_ALL_URL')
        );
        $this->get($url)->shouldBeArray();
    }

    function it_should_allow_to_POST_request()
    {
        $url = sprintf('%s%s',
            SimpleDotEnv::getVar('BASE_URL'),
            SimpleDotEnv::getVar('CREATE_ONE_URL')
        );
        $params = [
            'prop1' => 'value`',
        ];
        $this->post($url, $params)->shouldBeArray();
    }
}
