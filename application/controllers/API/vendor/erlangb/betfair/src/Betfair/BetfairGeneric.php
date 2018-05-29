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
use Betfair\Model\ParamInterface;

class BetfairGeneric extends AbstractBetfair
{
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

    public function executeCustomQuery(ParamInterface $param, $method)
    {
        return parent::executeCustomQuery($param, $method);
    }
}
