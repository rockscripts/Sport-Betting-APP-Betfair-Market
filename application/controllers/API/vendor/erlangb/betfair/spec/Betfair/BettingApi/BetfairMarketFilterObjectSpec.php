<?php

namespace spec\Betfair\BettingApi;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactory;
use Betfair\Factory\ParamFactoryInterface;

use Betfair\Model\MarketFilter;
use Betfair\Model\ParamInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BetfairMarketFilterObjectSpec extends ObjectBehavior
{
    protected $client;
    protected $adapterInterface;
    protected $paramFactory;
    protected $marketFilterFactory;

    protected $marketFilter;
    protected $locale;

    public function let(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapter,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory,
        MarketFilter $marketFilter
    ) {
        $this->beConstructedWith(
            $betfairClient,
            $adapter,
            $paramFactory,
            $marketFilterFactory
        );

        $this->marketFilter = $marketFilter;
        $this->locale = "locale";

        $this->withMarketFilter($this->marketFilter);
        $this->withLocale($this->locale);
    }

    public function it_get_results(ParamFactory $paramFactory,
                                   ParamInterface $param,
                                   BetfairClientInterface $betfairClient,
                                   AdapterInterface $adapter)
    {
        $paramFactory->create()->shouldBeCalled()->willReturn($param);
        $param->setMarketFilter($this->marketFilter)->shouldBeCalled();
        $param->setLocale($this->locale)->shouldBeCalled();

        $betfairClient->apiNgRequest("default", $param, "betting")->shouldBeCalled()->willReturn("response");
        $adapter->adaptResponse("response")->shouldBeCalled();

        $this->getResults();
    }

    public function it_set_market_filter(MarketFilter $marketFilter)
    {
        $this->withMarketFilter($marketFilter)->shouldEqual($this);
    }

    public function it_set_locale()
    {
        $this->withLocale("locale")->shouldEqual($this);
    }
}
