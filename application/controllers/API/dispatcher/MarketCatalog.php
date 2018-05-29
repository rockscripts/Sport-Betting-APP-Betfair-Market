<?php

use Betfair\BetfairFactory;
use Betfair\Model\MarketFilter;


class MarketCatalog
{
	public function listMarketCatalogByEventID($appKey, $username, $pwd, $eventIds)
	{
		$betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );
         $marketCatalog = $betfair->getBetfairMarketCatalogue();
		 $marketCatalogByEventIDs= $marketCatalog->getMarketCatalogueFilteredByEventIds($eventIds);
        return $marketCatalogByEventIDs;
	}
}
