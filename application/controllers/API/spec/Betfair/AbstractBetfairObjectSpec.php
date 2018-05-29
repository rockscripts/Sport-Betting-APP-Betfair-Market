<?php

namespace spec\Betfair;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\Model\MarketFilterInterface;
use Betfair\Model\ParamInterface;
use PhpSpec\ObjectBehavior;

class AbstractBetfairObjectSpec extends ObjectBehavior
{
    public function let(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapterInterface,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory
    ) {
        $this->beConstructedWith(
            $betfairClient,
            $adapterInterface,
            $paramFactory,
            $marketFilterFactory
        );
    }

    protected function it_create_empty_param_filter(
        MarketFilterFactoryInterface $marketFilterFactory,
        ParamFactoryInterface $paramFactory,
        MarketFilterInterface $marketFilterInterface,
        ParamInterface $paramInterface
    ) {
        $marketFilterFactory->create()
            ->shouldBeCalled()
            ->willReturn($marketFilterInterface);

        $paramFactory
            ->create()
            ->shouldBeCalled()
            ->willReturn($paramInterface);

        $paramInterface
            ->setMarketFilter($marketFilterInterface)
            ->shouldBeCalled();
    }
}
