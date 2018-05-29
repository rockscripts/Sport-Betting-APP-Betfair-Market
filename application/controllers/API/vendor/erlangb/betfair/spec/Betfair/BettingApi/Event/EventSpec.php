<?php

namespace spec\Betfair\BettingApi\Event;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Credential\CredentialInterface;
use Betfair\BettingApi\Event\Event;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactory;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\Helper\FilterHelper;
use Betfair\Model\MarketFilterInterface;
use Betfair\Model\ParamInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class EventSpec extends AbstractEventSpec
{
    protected $client;
    protected $adapterInterface;
    protected $paramFactory;
    protected $marketFilterFactory;

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

    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\BettingApi\Event\Event');
    }

    public function it_has_list_events(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapterInterface,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory,
        ParamInterface $paramInterface,
        MarketFilterInterface $marketFilterInterface
    ) {
        $this->it_create_empty_param_filter($marketFilterFactory, $paramFactory, $marketFilterInterface, $paramInterface);

        $betfairClient->apiNgRequest(Event::API_METHOD_NAME, $paramInterface, "betting")
            ->shouldBeCalled()
            ->willReturn("{response}");

        $adapterInterface->adaptResponse("{response}")->willReturn(array("response"));
        $this->listEvents()->shouldReturn(array("response"));
    }
}
