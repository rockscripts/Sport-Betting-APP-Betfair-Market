<?php

namespace Betfair\BettingApi\Order;

use Betfair\Adapter\AdapterInterface;
use Betfair\BettingApi\BetfairParamObject;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\Model\ParamInterface;

class ClearedOrder extends BetfairParamObject
{
    const API_METHOD_NAME = "listClearedOrders";

    /** @var  ParamInterface */
    protected $param;

    /**
     * @param BetfairClientInterface $betfairClient
     * @param AdapterInterface $adapter
     * @param ParamFactoryInterface $paramFactory
     * @param MarketFilterFactoryInterface $marketFilterFactory
     */
    public function __construct(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapter,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory
    ) {
        parent::__construct($betfairClient, $adapter, $paramFactory, $marketFilterFactory);
    }
}
