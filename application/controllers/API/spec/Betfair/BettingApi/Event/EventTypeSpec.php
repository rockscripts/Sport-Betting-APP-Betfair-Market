<?php

namespace spec\Betfair\BettingApi\Event;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\BettingApi\Event\EventType;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\Model\MarketFilterInterface;
use Betfair\Model\ParamInterface;
use Prophecy\Argument;

class EventTypeSpec extends AbstractEventSpec
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
        $this->shouldHaveType('Betfair\BettingApi\Event\EventType');
    }

    public function it_return_all_event_type(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapterInterface,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory,
        ParamInterface $paramInterface,
        MarketFilterInterface $marketFilterInterface
    ) {
        $this->it_create_empty_param_filter($marketFilterFactory, $paramFactory, $marketFilterInterface, $paramInterface);

        $betfairClient->apiNgRequest(EventType::API_METHOD_NAME, $paramInterface, "betting")
            ->shouldBeCalled()
            ->willReturn("{response}");

        $adapterInterface->adaptResponse("{response}")->willReturn(array("response"));

        $this->getAllEventType()->shouldReturn(array("response"));
    }

    public function it_return_all_event_type_filtered_by_ids(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapterInterface,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory,
        ParamInterface $paramInterface,
        MarketFilterInterface $marketFilterInterface
    ) {
        $eventTypeIds = array(1,2);

        $this->it_create_empty_param_filter($marketFilterFactory, $paramFactory, $marketFilterInterface, $paramInterface);

        $marketFilterInterface->setEventTypeIds($eventTypeIds)->shouldBeCalled();

        $betfairClient->apiNgRequest(EventType::API_METHOD_NAME, $paramInterface, "betting")
            ->shouldBeCalled()
            ->willReturn("{response}");

        $adapterInterface->adaptResponse("{response}")->willReturn(array("response"));

        $this->getAllEventFilterByIds($eventTypeIds)->shouldReturn(array("response"));
    }
}
