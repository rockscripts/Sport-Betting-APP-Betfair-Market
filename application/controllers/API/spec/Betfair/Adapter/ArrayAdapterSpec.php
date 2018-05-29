<?php

namespace spec\Betfair\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrayAdapterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\Adapter\ArrayAdapter');
    }

    public function it_have_adaptResponse()
    {
        $this->adaptResponse('{"ciao" : "hello"}')->shouldReturn(array('ciao' => 'hello'));
    }
}
