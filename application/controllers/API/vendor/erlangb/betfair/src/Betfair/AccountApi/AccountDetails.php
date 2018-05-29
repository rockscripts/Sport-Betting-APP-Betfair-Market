<?php

namespace Betfair\AccountApi;

use Betfair\AbstractBetfair;
use Betfair\BetfairActionType;

class AccountDetails extends AbstractBetfair
{
    const API_METHOD_NAME = "getAccountDetails";

    public function getAccountDetails()
    {
        $param = $this->createParam();
$param->setLocale("UK");
        return $this->executeCustomQuery($param, self::API_METHOD_NAME, BetfairActionType::ACCOUNT);
    }
}
