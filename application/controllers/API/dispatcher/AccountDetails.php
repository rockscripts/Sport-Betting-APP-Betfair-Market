<?php

use Betfair\BetfairFactory;


class AccountDetails
{
	public function getAccountDetails($appKey, $username, $pwd)
	{
		$betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );
         $accountDetails= $betfair->getBetfairAccountDetails();
	$accountDetailsResult = $accountDetails->getAccountDetails();
		 //echo $allEventType[0]["eventType"]["id"];die;
        return $accountDetailsResult;
	}
	
}
