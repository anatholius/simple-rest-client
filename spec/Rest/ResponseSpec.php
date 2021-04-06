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

    function it_should_allow_to_get_default_result_with_default_values()
    {
        $result = $this->getResult();
        $result->shouldBeArray();
        $result->shouldHaveKey('success');
        $result['success']->shouldBeBool();
        $result->shouldHaveKey('data');
        $result['data']->shouldBeNull();
        $result->shouldHaveKey('error');
        $result['error']->shouldBeNull();
    }
}
