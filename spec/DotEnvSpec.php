<?php

namespace spec\App;

use App\DotEnv;
use PhpSpec\Exception\Example\ErrorException;
use PhpSpec\ObjectBehavior;

class DotEnvSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DotEnv::class);
        $this->shouldNotThrow(\RuntimeException::class)->duringGetVars(true);
        $this->shouldThrow(\ArgumentCountError::class)->duringGetVar();
        $this->shouldNotThrow(ErrorException::class)->duringGetVar('UNKNOWN_VAR');
        $this->getVars(true)->shouldBeArray();
    }
}
