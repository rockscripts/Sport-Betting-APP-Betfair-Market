<?php

namespace Betfair\Model;

class PriceProjection extends BetfairSerializable
{

    /** @var  array  */
    protected $priceData;

    /** @var  ExBestOffersOverrides */
    protected $exBestOffersOverrides;

    /** @var  boolean */
    protected $virtualise;

    /** @var  boolean */
    protected $rolloverStakes;

    public function __construct($priceData = array())
    {
        $this->priceData = $priceData;
    }

    /**
     * @param \Betfair\Model\ExBestOffersOverrides $exBestOffersOverrides
     */
    public function setExBestOffersOverrides($exBestOffersOverrides)
    {
        $this->exBestOffersOverrides = $exBestOffersOverrides;
    }

    /**
     * @return \Betfair\Model\ExBestOffersOverrides
     */
    public function getExBestOffersOverrides()
    {
        return $this->exBestOffersOverrides;
    }

    /**
     * @param array $priceData
     */
    public function setPriceData($priceData)
    {
        $this->priceData = $priceData;
    }

    /**
     * @return array
     */
    public function getPriceData()
    {
        return $this->priceData;
    }

    /**
     * @param boolean $rolloverStakes
     */
    public function setRolloverStakes($rolloverStakes)
    {
        $this->rolloverStakes = $rolloverStakes;
    }

    /**
     * @return boolean
     */
    public function getRolloverStakes()
    {
        return $this->rolloverStakes;
    }

    /**
     * @param boolean $virtualise
     */
    public function setVirtualise($virtualise)
    {
        $this->virtualise = $virtualise;
    }

    /**
     * @return boolean
     */
    public function getVirtualise()
    {
        return $this->virtualise;
    }
}
