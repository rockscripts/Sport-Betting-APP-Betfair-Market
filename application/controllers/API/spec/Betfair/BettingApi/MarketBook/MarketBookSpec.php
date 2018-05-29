<?php

namespace spec\Betfair\BettingApi\MarketBook;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\Model\Param;
use Betfair\Model\ParamMarketBook;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MarketBookSpec extends ObjectBehavior
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
        $this->shouldHaveType('Betfair\BettingApi\MarketBook\MarketBook');
    }

    public function it_get_market_book_filtered_by_market_ids(
        Param $param
    ) {
        $response = '{response}';

        $this->paramFactory
            ->create()
            ->shouldBeCalled()
            ->willReturn($param);

        $param
            ->setMarketIds(array(1))
            ->shouldBeCalled();

        $this->client->apiNgRequest('listMarketBook', $param, "betting")
            ->shouldBeCalled()
            ->willReturn($response);

        $this->adapterInterface->adaptResponse($response)
            ->shouldBeCalled()
            ->willReturn(array('response'));

        $this->getMarketBookFilterByMarketIds(array(1));
    }
}
