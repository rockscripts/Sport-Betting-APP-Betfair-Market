<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\BettingApi\Country;

use Betfair\Adapter\AdapterInterface;
use Betfair\BettingApi\BetfairMarketFilterObject;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;

class Country extends BetfairMarketFilterObject
{
    const API_METHOD_NAME = "listCountries";

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
    public function listCountries()
    {
        $response = $this->apiNgRequest(
            self::API_METHOD_NAME,
            $this->createParam($this->createMarketFilter())
        );

        return $this->adapter->adaptResponse($response);
    }
}
