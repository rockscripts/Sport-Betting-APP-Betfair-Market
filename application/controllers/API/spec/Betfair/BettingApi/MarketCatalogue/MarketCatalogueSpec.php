<?php

namespace spec\Betfair\BettingApi\MarketCatalogue;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\BettingApi\MarketCatalogue\MarketCatalogue;
use Betfair\Model\MarketFilterInterface;
use Betfair\Model\MarketProjection;
use Betfair\Model\ParamInterface;
use Prophecy\Argument;
use spec\Betfair\AbstractBetfairObjectSpec;

class MarketCatalogueSpec extends AbstractBetfairObjectSpec
{
    protected $client;
    protected $adapterInterface;
    protected $paramFactory;
    protected $marketFilterFactory;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\BettingApi\MarketCatalogue\MarketCatalogue');
    }

    public function it_get_market_catalogue_filtered_by_event(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapterInterface,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory,
        ParamInterface $paramInterface,
        MarketFilterInterface $marketFilterInterface
    ) {
        $eventIds = array(1,2);

        $this->it_create_empty_param_filter($marketFilterFactory, $paramFactory, $marketFilterInterface, $paramInterface);

        $betfairClient->apiNgRequest(MarketCatalogue::API_METHOD_NAME, $paramInterface, "betting")
            ->shouldBeCalled()
            ->willReturn("{response}");

        $marketFilterInterface->setEventIds($eventIds)->shouldBeCalled();

        $paramInterface->setMaxResults(MarketCatalogue::MAX_RESULT)->shouldBeCalled();

        $adapterInterface->adaptResponse("{response}")->willReturn(array("response"));
        $this->getMarketCatalogueFilteredByEventIds($eventIds)->shouldReturn(array("response"));
    }

    public function it_list_market_catalogue(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapterInterface,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory,
        ParamInterface $paramInterface,
        MarketFilterInterface $marketFilterInterface
    ) {
        $eventTypeIds = array(1,2);
        $this->it_create_empty_param_filter($marketFilterFactory, $paramFactory, $marketFilterInterface, $paramInterface);

        $marketFilterInterface->setEventTypeIds($eventTypeIds);

        $paramInterface->setMaxResults(MarketCatalogue::MAX_RESULT)->shouldBeCalled();

        $betfairClient->apiNgRequest(MarketCatalogue::API_METHOD_NAME, $paramInterface, "betting")
            ->shouldBeCalled()
            ->willReturn("{response}");

        $adapterInterface->adaptResponse("{response}")->willReturn(array("response"));
        $this->listMarketCatalogue($eventTypeIds)->shouldReturn(array("response"));
    }

    public function it_get_market_catalogue_filtered_by(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapterInterface,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory,
        ParamInterface $paramInterface,
        MarketFilterInterface $marketFilterInterface
    ) {
        $eventIds = array(1,2);
        $marketTypeCodes = array(1234,5555);

        $this->it_create_empty_param_filter($marketFilterFactory, $paramFactory, $marketFilterInterface, $paramInterface);
        $marketFilterInterface->setEventIds($eventIds)->shouldBeCalled();
        $marketFilterInterface->setMarketTypeCodes($marketTypeCodes)->shouldBeCalled();

        $betfairClient->apiNgRequest(MarketCatalogue::API_METHOD_NAME, $paramInterface, "betting")
            ->shouldBeCalled()
            ->willReturn("{response}");

        $adapterInterface->adaptResponse("{response}")->willReturn(array("response"));
        $this->getMarketCatalogueFilteredBy($eventIds, $marketTypeCodes)->shouldReturn(array("response"));
    }
}
