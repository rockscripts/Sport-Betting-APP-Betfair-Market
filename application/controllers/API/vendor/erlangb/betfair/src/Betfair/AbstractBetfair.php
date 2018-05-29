<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair;

use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\Model\MarketFilterInterface;
use Betfair\Model\Param;
use Betfair\Model\ParamInterface;

abstract class AbstractBetfair
{
    const API_METHOD_NAME = "default";

    protected $betfairClient;

    protected $endPointUrl;

    protected $adapter;

    protected $marketFilterFactory;

    protected $paramFactory;

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
        $this->betfairClient = $betfairClient;
        $this->adapter = $adapter;
        $this->marketFilterFactory = $marketFilterFactory;
        $this->paramFactory =  $paramFactory;
    }

    public function executeCustomQuery(ParamInterface $param, $method = null, $type = "betting")
    {
        $method = $method !== null ? $method : $this::API_METHOD_NAME;
        $response = $this->apiNgRequest($method, $param, $type);
        return $this->adapter->adaptResponse($response);
    }

    /**
     * @param $operation
     * @param \Betfair\Model\Param|\Betfair\Model\ParamInterface $param
     * @param string $type
     * @internal param $params
     * @return mixed
     */
    public function apiNgRequest($operation, ParamInterface $param, $type = "betting")
    {
        $requestContent = $this->betfairClient->apiNgRequest(
            $operation,
            $param,
            $type
        );

        return $requestContent;
    }

    public function createMarketFilter()
    {
        return $this->marketFilterFactory->create();
    }

    public function createParam(MarketFilterInterface $marketFilter = null)
    {
        $param = $this->paramFactory->create();

        if ($marketFilter !== null) {
            $param->setMarketFilter($marketFilter);
        }

        return $param;
    }
}
