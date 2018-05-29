<?php

namespace Betfair;

use Betfair\Client\BetfairClient;
use Betfair\Client\BetfairGuzzleClientFactory;
use Betfair\Credential\Credential;

class BetfairFactory
{
    public static function createBetfair($applicationId, $betfairUsername, $betfairPassword, $options = array())
    {
        $credential = new Credential($applicationId, $betfairUsername, $betfairPassword);
        $factory = new BetfairGuzzleClientFactory(__DIR__."/Resources/specification");
        $betfairClient = new BetfairClient($credential, $factory->createBetfairGuzzleClient($options));

        $responseAdapter = null;

        if (isset($options["responseAdapter"])) {
            $responseAdapter = $options["responseAdapter"];
        }

        return new Betfair($betfairClient, $responseAdapter);
    }
}
