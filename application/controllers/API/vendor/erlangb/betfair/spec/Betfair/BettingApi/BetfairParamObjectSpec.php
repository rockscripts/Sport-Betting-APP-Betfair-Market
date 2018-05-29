<?php

namespace spec\Betfair\BettingApi;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactory;
use Betfair\Factory\ParamFactoryInterface;

use Betfair\Model\MarketFilter;
use Betfair\Model\Param;
use Betfair\Model\ParamInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BetfairParamObjectSpec extends ObjectBehavior
{
    protected $client;
    protected $adapterInterface;
    protected $paramFactory;
    protected $marketFilterFactory;

    protected $param;

    public function let(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapter,
        ParamInterface $param,
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

        $this->param = $param;
        $this->withParam($this->param);
    }


    public function it_get_results(BetfairClientInterface $betfairClient, AdapterInterface $adapter)
    {
        $betfairClient->apiNgRequest("default", $this->param, "betting")->shouldBeCalled()->willReturn("response");
        $adapter->adaptResponse("response")->shouldBeCalled();

        $this->getResults();
    }

    public function it_set_param(ParamInterface $parameter)
    {
        $this->withParam($parameter)->shouldEqual($this);
    }
}
