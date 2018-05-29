<?php

use Betfair\BetfairFactory;
use Betfair\Model\MarketFilter;


class SearchCompetitions
{
	public function listCompetitions($appKey, $username, $pwd)
	{
		$betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );
         $competitiosBetfair = $betfair->getBetfairCompetition();
		 $allcompetitios = $competitiosBetfair->getAllCompetitionsBy();
        return $allcompetitios;
	}
}
