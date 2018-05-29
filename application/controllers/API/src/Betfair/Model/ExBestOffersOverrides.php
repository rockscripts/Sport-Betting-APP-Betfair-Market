<?php

namespace Betfair\Model;

class ExBestOffersOverrides extends BetfairSerializable
{
    /** @var  int */
    protected $bestPricesDepth;

    /** @var  RollupModel */
    protected $rollupModel;

    /** @var  int */
    protected $rollupLimit;

    /** @var  double */
    protected $rollupLiabilityThreshold;

    /** @var  double */
    protected $rollupLiabilityFactor;

    /**
     * @param int $bestPricesDepth
     */
    public function setBestPricesDepth($bestPricesDepth)
    {
        $this->bestPricesDepth = $bestPricesDepth;
    }

    /**
     * @return int
     */
    public function getBestPricesDepth()
    {
        return $this->bestPricesDepth;
    }

    /**
     * @param float $rollupLiabilityFactor
     */
    public function setRollupLiabilityFactor($rollupLiabilityFactor)
    {
        $this->rollupLiabilityFactor = $rollupLiabilityFactor;
    }

    /**
     * @return float
     */
    public function getRollupLiabilityFactor()
    {
        return $this->rollupLiabilityFactor;
    }

    /**
     * @param float $rollupLiabilityThreshold
     */
    public function setRollupLiabilityThreshold($rollupLiabilityThreshold)
    {
        $this->rollupLiabilityThreshold = $rollupLiabilityThreshold;
    }

    /**
     * @return float
     */
    public function getRollupLiabilityThreshold()
    {
        return $this->rollupLiabilityThreshold;
    }

    /**
     * @param int $rollupLimit
     */
    public function setRollupLimit($rollupLimit)
    {
        $this->rollupLimit = $rollupLimit;
    }

    /**
     * @return int
     */
    public function getRollupLimit()
    {
        return $this->rollupLimit;
    }

    /**
     * @param \Betfair\Model\RollupModel $rollupModel
     */
    public function setRollupModel($rollupModel)
    {
        $this->rollupModel = $rollupModel;
    }

    /**
     * @return \Betfair\Model\RollupModel
     */
    public function getRollupModel()
    {
        return $this->rollupModel;
    }
}
