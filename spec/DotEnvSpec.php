<?php

namespace spec\App;

use App\DotEnv;
use PhpSpec\Exception\Example\ErrorException;
use PhpSpec\ObjectBehavior;

class DotEnvSpec extends ObjectBehavior
{
    function let()
    {
        $this->shouldNotThrow(\RuntimeException::class)->duringGetVars(true);
        $this->shouldThrow(\ArgumentCountError::class)->duringGetVar();
        $this->shouldNotThrow(ErrorException::class)->duringGetVar('UNKNOWN_VAR');
        $this->shouldNotThrow(\RuntimeException::class)->duringGetVar('BASE_URL');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DotEnv::class);
    }

    function it_should_allow_to_getVars()
    {
        $this->getVars(true)->shouldBeArray();
    }

    function it_should_return_null_when_getting_nonexistent_dotenv_variable()
    {
        $this->getVar('UNKNOWN_VAR')->shouldBeNull();
    }

    function it_should_allow_to_get_dotenv_variable()
    {
        $this->getVar('BASE_URL')->shouldBeString();
    }
}
