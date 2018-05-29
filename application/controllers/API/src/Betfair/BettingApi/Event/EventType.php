<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\BettingApi\Event;

use Betfair\Adapter\AdapterInterface;
use Betfair\BettingApi\BetfairMarketFilterObject;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;

class EventType extends BetfairMarketFilterObject
{
    const API_METHOD_NAME = "listEventTypes";

    const EVENT_TYPE_IDS_FILTER = "eventTypeIds";

    /**
     * @param BetfairClientInterface $betfairClient
     * @param AdapterInterface $adapter
     * @param \Betfair\Factory\ParamFactory|\Betfair\Factory\ParamFactoryInterface $paramFactory
     * @param \Betfair\Factory\MarketFilterFactory|\Betfair\Factory\MarketFilterFactoryInterface $marketFilterFactory
     */
    public function __construct(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapter,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory
    ) {
        parent::__construct($betfairClient, $adapter, $paramFactory, $marketFilterFactory);
    }

    /**
     * @return mixed
     */
    public function getAllEventType()
    {
        $response = $this->apiNgRequest(
            self::API_METHOD_NAME,
            $this->createParam($this->createMarketFilter())
        );

        return $this->adapter->adaptResponse($response);
    }

    /**
     * @param $eventTypeIds
     * @return mixed
     */
    public function getAllEventFilterByIds($eventTypeIds)
    {
        $marketFilter = $this->createMarketFilter();
        $marketFilter->setEventTypeIds($eventTypeIds);

        $param = $this->createParam($marketFilter);

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }
}
