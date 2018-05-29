<?php

use Betfair\BetfairFactory;
use Betfair\Model\MarketFilter;


class SearchEvents
{
	public function listEvents($appKey, $username, $pwd)
	{
		$betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );
         $eventTypeBetfair = $betfair->getBetfairEventType();
		 $allEventType = $eventTypeBetfair->getAllEventType();
		 //echo $allEventType[0]["eventType"]["id"];die;
        return $allEventType;
	}
	
    public function getAllEventsFilteredByCompetitionId($appKey, $username, $pwd, $competitionIDs)
    {
        $betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );

        $eventBetfair = $betfair->getBetfairEvent();
        $Events = $eventBetfair->getAllEventsFilteredByCompetition($competitionIDs);

        return $Events;
    }
	public function getAllEventsFilteredByEventId($appKey, $username, $pwd, $eventIDs)
    {
        $betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );

        $eventBetfair = $betfair->getBetfairEvent();
        $Events = $eventBetfair->getAllEventsFilteredByEvent($eventIDs);

        return $Events;
    }
 public function getAllEventFilteredByEventTypeIds($appKey, $username, $pwd, $eventType)
    {
        $betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );

        $eventBetfair = $betfair->getBetfairEvent();
        $Events = $eventBetfair->getAllEventFilteredByEventTypeIds($eventType);

        return $Events;
    }
    public function searchEventsWithTextQuery($appKey, $username, $pwd)
    {
        $seriaACompetition = 81;

        $betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );

        $betfairEvent = $betfair->getBetfairEvent();

        $marketFilter = MarketFilter::create();

        $marketFilter
            ->setTextQuery("Lazio")
            ->setCompetitionIds(array($seriaACompetition));

        $betfairEvent->withMarketFilter($marketFilter);
        $events = $betfairEvent->getResults();

        return $events;
    }

    public function searchEventsWithTimeRange($appKey, $username, $pwd)
    {
        $betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );

        $from = new DateTime('now + 1 month');
        $to = new DateTime("now + 1 month + 1 day");

        $timeZone = new \Betfair\Model\TimeRange($from, $to);

        $marketFilter = MarketFilter::create()
            ->setMarketStartTime($timeZone);

        $betfairEvent = $betfair->getBetfairEvent()
            ->withMarketFilter($marketFilter);


        return $betfairEvent->getResults();
    }
}
