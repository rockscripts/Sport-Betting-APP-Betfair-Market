<?php

use Betfair\BetfairFactory;
use Betfair\Model\BetStatus;
require '../vendor/autoload.php';
$appKey = "625s46b1GNKx4SMn";
$username = "rockscripts"; 
$pwd = "Rock!123";
$SearchEventsExample = new SearchClearedOrders();
$result = $SearchEventsExample->searchClearedOrder($appKey, $username, $pwd);
echo "<pre>";
print_r($result);
class SearchClearedOrders
{
    public function searchClearedOrder($appKey, $username, $pwd)
    {
        $betfair = BetfairFactory::createBetfair(
            $appKey,
            $username,
            $pwd
        );

        $clearedOrder = $betfair->getBetfairClearedOrder();

        $param = $clearedOrder->createParam();
        $param->setBetStatus(BetStatus::SETTLED);

        $clearedOrder->withParam($param);

        $results = $clearedOrder->getResults();

        return $results;
    }
}
