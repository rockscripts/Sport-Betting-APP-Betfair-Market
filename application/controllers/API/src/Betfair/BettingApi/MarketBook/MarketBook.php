<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\BettingApi\MarketBook;

use Betfair\AbstractBetfair;
use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\Model\PriceProjection;

class MarketBook extends AbstractBetfair
{
    const API_METHOD_NAME = "listMarketBook";

    private $marketIds;
    private $priceProjection;
    private $orderProjection;
    private $matchProjection;
    private $currencyCode;
    private $locale;

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

    public function getResults()
    {
        $param = $this->createParam();
        $param->setMarketIds($this->marketIds)
            ->setPriceProjection($this->priceProjection)
            ->setOrderProjection($this->orderProjection)
            ->setMarketProjection($this->matchProjection)
            ->setCurrencyCode($this->currencyCode)
            ->setLocale($this->locale);

        $this->restoreDefaults();
        return $this->executeCustomQuery($param, self::API_METHOD_NAME);
    }

    public function getMarketBookFilterByMarketIds(array $marketIds)
    {
        $param = $this->createParam();

        $param->setMarketIds($marketIds);

        $this->restoreDefaults();

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }
 public function getMarketBookFilterByEventsIds(array $eventIds)
    {
        $param = $this->createParam();

        $param->setEventIds($eventIds);

        $this->restoreDefaults();

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }
    public function getMarketBookFilterByMarketIdsWithPriceData(array $marketIds, array $priceData)
    {
        $param = $this->createParam();

        $param->setMarketIds($marketIds)
            ->setPriceProjection(new PriceProjection($priceData));

        $this->restoreDefaults();

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }

    public function getMarketBookFilterByMarketIdsWithPriceProjection(array $marketIds, PriceProjection $priceProjection)
    {
        $param = $this->createParam()
            ->setMarketIds($marketIds)
            ->setPriceProjection($priceProjection);

        $this->restoreDefaults();

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }

    public function withMarketIds($marketIds)
    {
        $this->marketIds = $marketIds;
        return $marketIds;
    }

    public function withPriceProjection(PriceProjection $priceProjection)
    {
        $this->priceProjection = $priceProjection;
        return $this;
    }

    public function withOrderProjection($orderProjection)
    {
        $this->orderProjection = $orderProjection;
        return $this;
    }

    public function withMatchProjection($matchProjection)
    {
        $this->matchProjection = $matchProjection;
        return $this;
    }

    public function withCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    public function withLocale($locale)
    {
        $this->locale = $locale;
    }

    private function restoreDefaults()
    {
        $this->marketIds = null;
        $this->priceProjection = null;
        $this->orderProjection = null;
        $this->matchProjection = null;
        $this->currencyCode = null;
    }
}
