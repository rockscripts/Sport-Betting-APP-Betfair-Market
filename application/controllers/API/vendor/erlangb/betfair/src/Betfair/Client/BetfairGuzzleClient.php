<?php

namespace Betfair\Client;

class BetfairGuzzleClient
{

    private $guzzleClient;

    public function __construct($guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function apiNgRequest(array $guzzleParameters)
    {
        $response = $this->guzzleClient->apiNgRequest(
            $guzzleParameters
        );

        return $response;
    }

    public function betfairLogin(array $guzzleParameters)
    {
        $response = $this->guzzleClient->betfairLogin(
            $guzzleParameters
        );

        return $response;
    }
}
