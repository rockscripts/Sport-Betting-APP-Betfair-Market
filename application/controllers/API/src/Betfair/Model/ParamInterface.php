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

interface ParamInterface
{
    public function jsonSerialize();

    /**
     * @param $marketProjection
     * @return $this
     */
    public function setMarketProjection($marketProjection);

    /**
     * @param $maxResult
     * @return $this
     */
    public function setMaxResults($maxResult);

    /**
     * @param $marketProjection
     * @return $this
     */
    public function addMarketProjection($marketProjection);

    /**
     * @param MarketFilterInterface $filter
     * @return $this
     */
    public function setMarketFilter(MarketFilterInterface $filter = null);

    /**
     * @param $currencyCode
     * @return $this
     */
    public function setCurrencyCode($currencyCode);

    /**
     * @param $locale
     * @return $this
     */
    public function setLocale($locale);

    /**
     * @param $marketIds
     * @return $this
     */
    public function setMarketIds(array $marketIds);

    /**
     * @param MarketProjection $matchProjection
     * @return $this
     */
    public function setMatchProjection(MarketProjection $matchProjection);

    /**
     * @param $orderProjection
     * @return $this
     */
    public function setOrderProjection($orderProjection);

    /**
     * @param PriceProjection $priceProjection
     * @return $this
     */
    public function setPriceProjection(PriceProjection $priceProjection);

    /**
     * @param $marketSort
     * @return $this
     */
    public function setMarketSort($marketSort);

    /**
     * @param $eventTypeIds
     * @return $this
     */
    public function setEventTypeIds(array $eventTypeIds);

    /**
     * @param $eventIds
     * @return $this
     */
    public function setEventIds(array $eventIds);

    /**
     * @param $runnerIds
     * @return $this
     */
    public function setRunnerIds(array $runnerIds);

    /**
     * @param $betIds
     * @return $this
     */
    public function setBetIds(array $betIds);

    /**
     * @param $side
     * @return $this
     */
    public function setSide($side);

    /**
     * @param $settledDateRange
     * @return $this
     */
    public function setSettledDateRange(TimeRange $settledDateRange);

    /**
     * @param $groupBy
     * @return $this
     */
    public function setGroupBy($groupBy);

    /**
     * @param $includeItemDescription
     * @return $this
     */
    public function setIncludeItemDescription($includeItemDescription);

    /**
     * @param int $fromRecord
     * @return $this
     */
    public function setFromRecord($fromRecord);

    /**
     * @param $recordCount
     * @return int
     */
    public function setRecordCount($recordCount);

    /**
     * @param TimeRange $dateRange
     * @return $this
     */
    public function setDateRange(TimeRange $dateRange);

    /**
     * @param $orderBy
     * @return $this
     */
    public function setOrderBy($orderBy);

    /**
     * @param $sortDir
     * @return $this
     */
    public function setSortDir($sortDir);

    /**
     * @param $betStatus
     * @return mixed
     */
    public function setBetStatus($betStatus);
}
