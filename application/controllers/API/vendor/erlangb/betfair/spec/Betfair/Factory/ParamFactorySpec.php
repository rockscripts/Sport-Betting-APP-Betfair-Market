<?php

namespace spec\Betfair\Factory;

use Betfair\Model\MarketFilterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParamFactorySpec extends ObjectBehavior
{
    public function let(MarketFilterInterface $marketFilter)
    {
    }
    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\Factory\ParamFactory');
    }

    public function it_is_have_create(MarketFilterInterface $marketFilter)
    {
        $this->create($marketFilter)->shouldReturnAnInstanceOf('Betfair\Model\ParamInterface');
    }
}
