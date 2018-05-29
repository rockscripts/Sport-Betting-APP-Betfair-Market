<?php

namespace Betfair\AccountApi;

use Betfair\AbstractBetfair;
use Betfair\BetfairActionType;

class AccountFunds extends AbstractBetfair
{
    const API_METHOD_NAME = "getAccountFunds";

    public function getAccountFunds()
    {
        $param = $this->createParam();

        return $this->executeCustomQuery($param, self::API_METHOD_NAME, BetfairActionType::ACCOUNT);
    }
}
