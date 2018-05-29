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

interface MarketFilterInterface
{
    /**
     * @param $competitionIds
     * @return $this
     */
    public function setCompetitionIds($competitionIds);

    /**
     * @param $eventIds
     * @return $this
     */
    public function setEventIds(array $eventIds);

    /**
     * @param $eventTypeIds
     * @return $this
     */
    public function setEventTypeIds($eventTypeIds);

    /**
     * @param $exchangeIds
     * @return $this
     */
    public function setExchangeIds($exchangeIds);

    /**
     * @param $inPlayOnly
     * @return $this
     */
    public function setInPlayOnly($inPlayOnly);

    /**
     * @param $marketBettingTypes
     * @return $this
     */
    public function setMarketBettingTypes($marketBettingTypes);

    /**
     * @param $contries
     * @return $this
     */
    public function setMarketCountries($contries);

    /**
     * @param $marketIds
     * @return $this
     */
    public function setMarketIds($marketIds);

    /**
     * @param $marketStartTime
     * @return $this
     */
    public function setMarketStartTime($marketStartTime);

    /**
     * @param $marketTypeCodes
     * @return $this
     */
    public function setMarketTypeCodes($marketTypeCodes);

    /**
     * @param $textQuery
     * @return $this
     */
    public function setTextQuery($textQuery);

    /**
     * @param $inPlay
     * @return $this
     */
    public function setTurnInPlayEnabled($inPlay);

    /**
     * @param $venues
     * @return $this
     */
    public function setVenues($venues);

    /**
     * @param $withOrders
     * @return $this
     */
    public function setWithOrders($withOrders);
}
