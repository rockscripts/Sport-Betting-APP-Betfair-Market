<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\BettingApi\MarketCatalogue;

use Betfair\AbstractBetfair;
use Betfair\Adapter\AdapterInterface;
use Betfair\Client\BetfairClientInterface;
use Betfair\Factory\MarketFilterFactoryInterface;
use Betfair\Factory\ParamFactoryInterface;
use Betfair\Model\MarketFilter;
use Betfair\Model\MarketProjection;

class MarketCatalogue extends AbstractBetfair
{
    const API_METHOD_NAME = "listMarketCatalogue";
    const MAX_RESULT = "100";

    private $maxResults;
    private $marketProjections;
    private $marketSort;
    private $locale;
    private $marketFilter;

    /**
     * @param BetfairClientInterface $betfairClient
     * @param AdapterInterface $adapter
     * @param \Betfair\Factory\ParamFactoryInterface $paramFactory
     * @param \Betfair\Factory\MarketFilterFactoryInterface $marketFilterFactory
     */
    public function __construct(
        BetfairClientInterface $betfairClient,
        AdapterInterface $adapter,
        ParamFactoryInterface $paramFactory,
        MarketFilterFactoryInterface $marketFilterFactory
    ) {
        parent::__construct($betfairClient, $adapter, $paramFactory, $marketFilterFactory);
        $this->restoreDefaultsProperties();
    }

    public function getResults()
    {
        $param = $this->createParam($this->marketFilter)
            ->setMaxResults($this->maxResults)
            ->setLocale($this->locale)
            ->setMarketSort($this->marketSort)
            ->setMarketProjection($this->marketProjections);

        $this->restoreDefaultsProperties();

        return $this->executeCustomQuery($param);
    }
    public function getRunnersByCompetitionID($competitionIDs)
	{
		$marketFilter = $this->createMarketFilter();
        $marketFilter->setCompetitionIds($competitionIDs);
        $param = $this->createParam($marketFilter)
            ->setMaxResults($this->maxResults)			
            ->setMarketProjection(array(MarketProjection::RUNNER_DESCRIPTION));

        $this->restoreDefaultsProperties();

        return $this->executeCustomQuery($param);
	}
    public function listMarketCatalogue(array $eventTypes)
    {
        $filter = $this->createMarketFilter();
        $filter->setEventTypeIds($eventTypes);

        $param = $this->createParam($filter);

        $param->setMaxResults(self::MAX_RESULT);

        $this->restoreDefaultsProperties();

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }

    public function getMarketCatalogueFilteredByEventIds(array $eventIds)
    {
        $marketFilter = $this->createMarketFilter();
        $marketFilter->setEventIds($eventIds);

        $param = $this->createParam($marketFilter)->setMarketProjection($this->marketProjections)->setLocale("ES");

        $param->setMaxResults(self::MAX_RESULT);

        $this->restoreDefaultsProperties();

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }

    public function getMarketCatalogueFilteredBy(array $eventIds, array $marketTypes)
    {
        $marketFilter = $this->createMarketFilter();
        $marketFilter->setEventIds($eventIds);
        $marketFilter->setMarketTypeCodes($marketTypes);

        $param = $this->createParam($marketFilter);

        $param->setMaxResults(self::MAX_RESULT);

        $this->restoreDefaultsProperties();

        return $this->adapter->adaptResponse(
            $this->apiNgRequest(self::API_METHOD_NAME, $param)
        );
    }

    private function restoreDefaultsProperties()
    {
        $this->marketSort = null;
        $this->locale = null;
        $this->marketProjections = MarketProjection::getAll();
        $this->maxResults = self::MAX_RESULT;
    }

    public function withMarketFilter(MarketFilter $marketFilter)
    {
        $this->marketFilter = $marketFilter;
        return $this;
    }

    public function withMarketSort($marketSort)
    {
        $this->marketSort = $marketSort;
        return $this;
    }

    public function withMarketProjections(array $marketProjections)
    {
        $this->marketProjections = $marketProjections;
        return $this;
    }

    public function withMaxResult($maxResult)
    {
        $this->maxResults = $maxResult;
        return $this;
    }

    public function withLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }
}
