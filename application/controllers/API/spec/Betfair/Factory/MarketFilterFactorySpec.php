<?php

namespace spec\Betfair\Factory;

use Betfair\Model\MarketFilterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MarketFilterFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\Factory\MarketFilterFactory');
    }

    public function it_is_have_create()
    {
        $this->create()->shouldReturnAnInstanceOf('Betfair\Model\MarketFilterInterface');
    }
}
