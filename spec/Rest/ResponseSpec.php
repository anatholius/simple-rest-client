<?php

namespace spec\App\Rest;

use App\Rest\Response;
use App\Rest\ResponseInterface;
use PhpSpec\ObjectBehavior;

class ResponseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(["curl" => "result"], ['curl' => 'info']);
        $this->shouldHaveType(Response::class);
        $this->shouldImplement(ResponseInterface::class);
    }

    function it_should_allow_to_get_default_result_with_default_values()
    {
        $this->beConstructedWith('{"curl":failed}Warning...', ['curl' => 'info']);

        $result = $this->getResult();
        $result->shouldBeArray();
        $result->shouldHaveKey('success');
        $result['success']->shouldBeBool();
        $result->shouldHaveKey('data');
        $result['data']->shouldBeNull();
        $result->shouldHaveKey('error');
        $result['error']->shouldBeArray();
    }

    function it_should_allow_to_get_result_with_processed_values()
    {
        $this->beConstructedWith(["curl" => "result"], ['curl' => 'info']);

        $result = $this->getResult();
        $result->shouldBeArray();
        $result->shouldHaveKey('success');
        $result['success']->shouldBeBool();
        $result->shouldHaveKey('data');
        $result['data']->shouldBeArray();
        $result->shouldHaveKey('error');
        $result['error']->shouldBeNull();
    }
}
