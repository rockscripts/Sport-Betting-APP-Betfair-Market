<?php

use Betfair\BetfairFactory;
use Betfair\Model\PriceProjection;

class SearchMarketBook
{

    public function searchWithExBestOffer($appKey, $username, $pwd,$marketIDs)
    {
        $betfair = BetfairFactory::createBetfair($appKey, $username, $pwd);

        $marketBookBetfair = $betfair->getBetfairMarketBook();

        $priceProjection = new PriceProjection(array(\Betfair\Model\PriceData::EX_BEST_OFFERS));

        $marketBookBetfair
            ->withPriceProjection($priceProjection)
            ->withMarketIds($marketIDs);

        $results = $marketBookBetfair->getResults();

        return $results;
    }
     public function searchResults($appKey, $username, $pwd,$marketIDs)
    {
        $betfair = BetfairFactory::createBetfair($appKey, $username, $pwd);

        $marketBookBetfair = $betfair->getBetfairMarketBook();

        $priceProjection = new PriceProjection(array(\Betfair\Model\PriceData::SP_TRADED));

        $marketBookBetfair
            ->withPriceProjection($priceProjection)
            ->withMarketIds($marketIDs);

        $results = $marketBookBetfair->getResults();

        return $results;
    }
	public function getRunnersByCompetitionID($appKey, $username, $pwd,$competitionIDs)
    {
        $betfair = BetfairFactory::createBetfair($appKey, $username, $pwd);
        $marketBookBetfair = $betfair->getBetfairMarketCatalogue();
		$results = $marketBookBetfair->getRunnersByCompetitionID($competitionIDs);

        return $results;
    }
	
}
