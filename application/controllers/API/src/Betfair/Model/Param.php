<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\Model;

class Param extends BetfairSerializable implements ParamInterface
{
    /** @var  array */
    protected $marketIds;

    /** @var  PriceProjection */
    protected $priceProjection;

    /** @var  OrderProjection */
    protected $orderProjection;

    /** @var  MatchProjection */
    protected $matchProjection;

    /** @var  MarketFilter */
    protected $filter;

    /** @var  int */
    protected $maxResults;

    /** @var  array */
    protected $marketProjection;

    /** @var  string */
    protected $locale;

    /** @var  string */
    protected $currencyCode;

    /** @var  MarketSort */
    protected $marketSort;

    /** @var  $eventTypeIds */
    protected $eventTypeIds;

    /** @var  array $runnerIds */
    protected $runnerIds;

    /** @var  array $eventIds */
    protected $eventIds;

    /** @var  array $betIds */
    protected $betIds;

    /** @var  string $side */
    protected $side;

    /** @var  TimeRange $settledDateRange */
    protected $settledDateRange;

    /** @var  string $groupBy */
    protected $groupBy;

    /** @var  bool $includeItemDescription */
    protected $includeItemDescription;

    /** @var  int $fromRecord */
    protected $fromRecord;

    /** @var  int $recordCount */
    protected $recordCount;

    /** @var  TimeRange $timeRange */
    protected $timeRange;

    /** @var  TimeRange $dateRange */
    protected $dateRange;

    /** @var  $orderBy */
    protected $orderBy;

    /** @var  $sortDir */
    protected $sortDir;

    protected $betStatus;

    public static function create()
    {
        return new Param();
    }

    public function setMarketFilter(MarketFilterInterface $filter = null)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @param array $marketProjection
     * @return $this
     */
    public function setMarketProjection($marketProjection)
    {
        $this->marketProjection = $marketProjection;
        return $this;
    }

    public function addMarketProjection($marketProjection)
    {
        $this->marketProjection[] = $marketProjection;
        return $this;
    }

    /**
     * @param MarketFilterInterface $filter
     * @return $this
     */
    public function setFilter(MarketFilterInterface $filter = null)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @param $maxResults
     * @return $this
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
        return $this;
    }

    /**
     * @param string $currencyCode
     * @return $this
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @param array $marketIds
     * @return $this
     */
    public function setMarketIds(array $marketIds)
    {
        $this->marketIds = $marketIds;
        return $this;
    }

    /**
     * @param MarketProjection $matchProjection
     * @return $this
     */
    public function setMatchProjection(MarketProjection $matchProjection)
    {
        $this->matchProjection = $matchProjection;
        return $this;
    }

    /**
     * @param \Betfair\Model\OrderProjection $orderProjection
     * @return $this
     */
    public function setOrderProjection($orderProjection)
    {
        $this->orderProjection = $orderProjection;
        return $this;
    }

    /**
     * @param \Betfair\Model\MarketSort $marketSort
     * @return $this
     */
    public function setMarketSort($marketSort)
    {
        $this->marketSort = $marketSort;
        return $this;
    }

    /**
     * @param PriceProjection $priceProjection
     * @return $this
     */
    public function setPriceProjection(PriceProjection $priceProjection)
    {
        $this->priceProjection = $priceProjection;
        return $this;
    }

    /**
     * @param $eventTypeIds
     * @return $this
     */
    public function setEventTypeIds(array $eventTypeIds)
    {
        $this->eventTypeIds = $eventTypeIds;
        return $this;
    }

    /**
     * @param $eventIds
     * @return $this
     */
    public function setEventIds(array $eventIds)
    {
        $this->eventIds = $eventIds;
        return $this;
    }

    /**
     * @param $runnerIds
     * @return $this
     */
    public function setRunnerIds(array $runnerIds)
    {
        $this->runnerIds = $runnerIds;
        return $this;
    }

    /**
     * @param $betIds
     * @return $this
     */
    public function setBetIds(array $betIds)
    {
        $this->betIds = $betIds;
        return $this;
    }

    /**
     * @param $side
     * @return $this
     */
    public function setSide($side)
    {
        $this->side = $side;
        return $this;
    }

    /**
     * @param $settledDateRange
     * @return $this
     */
    public function setSettledDateRange(TimeRange $settledDateRange)
    {
        $this->settledDateRange = $settledDateRange;
        return $this;
    }

    /**
     * @param string $groupBy
     * @return $this
     */
    public function setGroupBy($groupBy)
    {
        $this->groupBy = $groupBy;
        return $this;
    }

    /**
     * @param bool $includeItemDescription
     * @return $this
     */
    public function setIncludeItemDescription($includeItemDescription)
    {
        $this->includeItemDescription = $includeItemDescription;
        return $this;
    }

    /**
     * @param int $fromRecord
     * @return $this
     */
    public function setFromRecord($fromRecord)
    {
        $this->fromRecourd = $fromRecord;
        return $this;
    }

    /**
     * @param $recordCount
     * @return int
     */
    public function setRecordCount($recordCount)
    {
        $this->recordCount = $recordCount;
        return $this;
    }

    /**
     * @param TimeRange $dateRange
     * @return $this
     */
    public function setDateRange(TimeRange $dateRange)
    {
        $this->dateRange = $dateRange;
        return $this;
    }

    /**
     * @param $orderBy
     * @return $this
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param $sortDir
     * @return $this
     */
    public function setSortDir($sortDir)
    {
        $this->sortDir = $sortDir;
        return $this;
    }

    public function setBetStatus($betStatus)
    {
        $this->betStatus = $betStatus;
        return $this;
    }
}
