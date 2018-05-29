<?php

use Betfair\BetfairFactory;
use Betfair\Model\PriceProjection;


class SearchMarketBookExample
{

    public function searchWithExBestOffer($appKey, $username, $pwd)
    {
        $betfair = BetfairFactory::createBetfair($appKey, $username, $pwd);

        $marketBookBetfair = $betfair->getBetfairMarketBook();

        $priceProjection = new PriceProjection(array(\Betfair\Model\PriceData::EX_BEST_OFFERS));

        $marketBookBetfair
            ->withPriceProjection($priceProjection)
            ->withMarketIds(array(1.117549116));

        $results = $marketBookBetfair->getResults();

        return $results;
    }
}
