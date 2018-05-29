<?php

use Betfair\BetfairFactory;


class Country
{
	public function listCountries($appKey, $username, $pwd)
	{
		$betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );
         $countryBetfair = $betfair->getBetfairCountry();
	 $allCountries = $countryBetfair->listCountries($appKey, $username, $pwd);
         return $allCountries;
	}	
}
