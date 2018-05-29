<?php

namespace spec\Betfair;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Client\BetfairJsonRpcClientInterface;
use PhpSpec\ObjectBehavior;

class BetfairSpec extends ObjectBehavior
{

    public function let(
        BetfairClientInterface $client,
        AdapterInterface $adapterInterface
    ) {
        $this->beConstructedWith($client, $adapterInterface);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\Betfair');
    }

    public function it_has_factory_event()
    {
        $this->getBetfairEvent()->shouldReturnAnInstanceOf('Betfair\BettingApi\Event\Event');
    }

    public function it_has_factory_generic()
    {
        $this->getBetfairGeneric()->shouldReturnAnInstanceOf('Betfair\BetfairGeneric');
    }

    public function it_has_factory_eventType()
    {
        $this->getBetfairEventType()->shouldReturnAnInstanceOf('Betfair\BettingApi\Event\EventType');
    }

    public function it_has_factory_MarketCatalogue()
    {
        $this->getBetfairMarketCatalogue()->shouldReturnAnInstanceOf('Betfair\BettingApi\MarketCatalogue\MarketCatalogue');
    }

    public function it_has_factory_MarketBook()
    {
        $this->getBetfairMarketBook()->shouldReturnAnInstanceOf('Betfair\BettingApi\MarketBook\MarketBook');
    }

    public function it_has_factory_Country()
    {
        $this->getBetfairCountry()->shouldReturnAnInstanceOf('Betfair\BettingApi\Country\Country');
    }

    public function it_is_factory_Competition()
    {
        $this->getBetfairCompetition()->shouldReturnAnInstanceOf('Betfair\BettingApi\Competition\Competition');
    }

    public function it_is_factory_TimeRange()
    {
        $this->getBetfairTimeRange()->shouldReturnAnInstanceOf('Betfair\BettingApi\TimeRange\TimeRange');
    }
}
