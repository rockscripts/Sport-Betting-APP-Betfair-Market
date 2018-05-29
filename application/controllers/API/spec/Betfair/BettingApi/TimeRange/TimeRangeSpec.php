<?php

namespace spec\Betfair\BettingApi\TimeRange;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TimeRangeSpec extends ObjectBehavior
{
    protected $client;
    protected $adapterInterface;
    protected $paramFactory;
    protected $marketFilterFactory;

    public function let(
        BetfairClientInterface $client,
        AdapterInterface $adapterInterface,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory
    ) {
        $this->client = $client;
        $this->adapterInterface =  $adapterInterface;
        $this->paramFactory = $paramFactory;
        $this->marketFilterFactory = $marketFilterFactory;

        $this->beConstructedWith(
            $this->client,
            $this->adapterInterface,
            $this->paramFactory,
            $this->marketFilterFactory
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\BettingApi\TimeRange\TimeRange');
    }
}
