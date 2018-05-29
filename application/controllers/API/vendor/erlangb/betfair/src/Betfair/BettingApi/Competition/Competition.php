<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\BettingApi\Competition;

use Betfair\Adapter\AdapterInterface;
use Betfair\BettingApi\BetfairMarketFilterObject;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;

/**
 * Class Competition
 * @package Betfair\BettingApi\Competition
 */
class Competition extends BetfairMarketFilterObject
{
    const API_METHOD_NAME = "listCompetitions";

    /**
     * @param BetfairClientInterface $betfairClient
     * @param AdapterInterface $adapter
     * @param \Betfair\Factory\ParamFactory|\Betfair\Factory\ParamFactoryInterface $paramFactory
     * @param \Betfair\Factory\MarketFilterFactory|\Betfair\Factory\MarketFilterFactoryInterface $marketFilterFactory
     */
    public function __construct(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapter,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory
    ) {
        parent::__construct($betfairClient, $adapter, $paramFactory, $marketFilterFactory);
    }
	public function getAllCompetitions()
	{
		 $response = $this->apiNgRequest(
            self::API_METHOD_NAME,
            $this->createParam($this->createMarketFilter())
        );

        return $this->adapter->adaptResponse($response);
	}
	public function getAllCompetitionsBy()
	{
		$marketFilter = $this->createMarketFilter();
        $marketFilter->setEventTypeIds(array(1));

        $param = $this->createParam($marketFilter)->setLocale("ES");

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
	}
}
