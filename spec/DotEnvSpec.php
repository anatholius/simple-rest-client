<?php

namespace spec\App;

use App\DotEnv;
use PhpSpec\ObjectBehavior;

class DotEnvSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DotEnv::class);
        $this->shouldNotThrow(\RuntimeException::class)->duringGetVars(true);
        $this->getVars(true)->shouldBeArray();
    }
}
