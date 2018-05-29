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

/**
 * Class Event
 * @package Betfair\BettingApi\Event
 */
class Event extends BetfairMarketFilterObject
{
    /**
     * The API METHOD NAME
     */
    const API_METHOD_NAME = "listEvents";

    /**
     * @param BetfairClientInterface $betfairClient
     * @param AdapterInterface $adapter
     * @param ParamFactoryInterface $paramFactory
     * @param MarketFilterFactoryInterface $marketFilterFactory
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
    public function listEvents()
    {
        $response = $this->apiNgRequest(
            self::API_METHOD_NAME,
            $this->createParam($this->createMarketFilter())
        );

        return $this->adapter->adaptResponse($response);
    }

    /**
     * @param array $eventTypeIds
     * @return mixed
     */
    public function getAllEventFilteredByEventTypeIds(array $eventTypeIds)
    {
        $marketFilter = $this->createMarketFilter();
        $marketFilter->setEventTypeIds($eventTypeIds);
        $param = $this->createParam($marketFilter)
                 ->setLocale("ES");;
        
        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }

    /**
     * @param array $competitionIds
     * @internal param array $eventTypeIds
     * @return mixed
     */
    public function getAllEventsFilteredByCompetition(array $competitionIds)
    {
        $marketFilter = $this->createMarketFilter();
        $marketFilter->setCompetitionIds($competitionIds);
        $param = $this->createParam($marketFilter)->setLocale("ES");
        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }
	public function getAllEventsFilteredByEvent(array $eventIDs)
    {
        $marketFilter = $this->createMarketFilter();
        $marketFilter->setEventIds($eventIDs);
        $param = $this->createParam($marketFilter)->setLocale("ES");
        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }
	public function getAllEventsFilteredByTimeRange()
    {
		$from = new  \DateTime('now');
        $to = new  \DateTime("now + 1 month");
        $marketFilter = $this->createMarketFilter();
		$timeZone = new \Betfair\Model\TimeRange($from, $to);
		
        $marketFilter->setMarketStartTime($timeZone);						
        
        $param = $this->createParam($marketFilter)->setLocale("ES")  ->setMarketProjection(array(MarketProjection::COMPETITION));

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }
}
