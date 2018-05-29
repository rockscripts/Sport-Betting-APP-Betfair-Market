<?php

use Betfair\BetfairFactory;
use Betfair\Model\MarketFilter;

require '../vendor/autoload.php';

class SearchEventsExample
{
    public function getAllEventFilteredByEventTypeIds($appKey, $username, $pwd)
    {
        $eventTypeSoccer = 1;

        $betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );

        $eventBetfair = $betfair->getBetfairEvent();
        $soccerEvents = $eventBetfair->getAllEventFilteredByEventTypeIds(array($eventTypeSoccer));

        return $soccerEvents;
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
