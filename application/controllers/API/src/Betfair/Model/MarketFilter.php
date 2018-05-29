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

class MarketFilter extends BetfairSerializable implements MarketFilterInterface
{
    /**
     * @var string
     */
    protected $textQuery;

    /**
     * @var array
     */
    protected $exchangeIds;

    /**
     * @var array
     */
    protected $eventTypeIds;

    /**
     * @var array
     */
    protected $eventIds;

    /**
     * @var array
     */
    protected $competitionIds;

    /**
     * @var array
     */
    protected $marketIds;

    /**
     * @var array
     */
    protected $venues;

    /**
     * @var boolean
     */
    protected $bspOnly;

    /**
     * @var boolean
     */
    protected $turnInPlayEnabled;

    /**
     * @var boolean
     */
    protected $inPlayOnly;

    /**
     * @var array
     */
    protected $marketBettingTypes;

    /**
     * @var array
     */
    protected $marketCountries;

    /**
     * @var array
     */
    protected $marketTypeCodes;

    /**
     * @var TimeRange
     */
    protected $marketStartTime;

    /**
     * @var array OrderStatus
     */
    protected $withOrders;

    public static function create()
    {
        return new MarketFilter();
    }

    /**
     * @param boolean $bspOnly
     * @return $this
     */
    public function setBspOnly($bspOnly)
    {
        $this->bspOnly = $bspOnly;
        return $this;
    }

    /**
     * @param array $competitionIds
     * @return $this|mixed
     */
    public function setCompetitionIds($competitionIds)
    {
        $this->competitionIds = $competitionIds;
        return $this;
    }

    /**
     * @param array $eventIds
     * @return $this
     */
    public function setEventIds(array $eventIds)
    {
        $this->eventIds = $eventIds;
        return $this;
    }

    /**
     * @param array $eventTypeIds
     * @return $this
     */
    public function setEventTypeIds($eventTypeIds)
    {
        $this->eventTypeIds = $eventTypeIds;
        return $this;
    }

    /**
     * @param array $exchangeIds
     * @return $this
     */
    public function setExchangeIds($exchangeIds)
    {
        $this->exchangeIds = $exchangeIds;
        return $this;
    }

    /**
     * @param boolean $inPlayOnly
     * @return $this
     */
    public function setInPlayOnly($inPlayOnly)
    {
        $this->inPlayOnly = $inPlayOnly;
        return $this;
    }

    /**
     * @param array $marketBettingTypes
     * @return $this
     */
    public function setMarketBettingTypes($marketBettingTypes)
    {
        $this->marketBettingTypes = $marketBettingTypes;
        return $this;
    }

    /**
     * @param array $marketCountries
     * @return $this
     */
    public function setMarketCountries($marketCountries)
    {
        $this->marketCountries = $marketCountries;
        return $this;
    }

    /**
     * @param array $marketIds
     * @return $this
     */
    public function setMarketIds($marketIds)
    {
        $this->marketIds = $marketIds;
        return $this;
    }

    /**
     * @param \Betfair\Model\TimeRange $marketStartTime
     * @return $this
     */
    public function setMarketStartTime($marketStartTime)
    {
        $this->marketStartTime = $marketStartTime;
        return $this;
    }

    /**
     * @param string $textQuery
     * @return $this|mixed
     */
    public function setTextQuery($textQuery)
    {
        $this->textQuery = $textQuery;
        return $this;
    }

    /**
     * @param boolean $turnInPlayEnabled
     * @return $this
     */
    public function setTurnInPlayEnabled($turnInPlayEnabled)
    {
        $this->turnInPlayEnabled = $turnInPlayEnabled;
        return $this;
    }

    /**
     * @param array $venues
     * @return $this
     */
    public function setVenues($venues)
    {
        $this->venues = $venues;
        return $this;
    }

    /**
     * @param array $withOrders
     * @return $this|mixed
     */
    public function setWithOrders($withOrders)
    {
        $this->withOrders = $withOrders;
        return $this;
    }

    /**
     * @param $marketTypeCodes
     * @return $this
     */
    public function setMarketTypeCodes($marketTypeCodes)
    {
        $this->marketTypeCodes = $marketTypeCodes;
        return $this;
    }
}
