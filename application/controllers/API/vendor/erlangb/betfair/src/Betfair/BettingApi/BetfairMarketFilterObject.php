<?php

namespace Betfair\BettingApi;

use Betfair\AbstractBetfair;
use Betfair\Model\MarketFilter;

class BetfairMarketFilterObject extends AbstractBetfair
{
    protected $marketFilter;
    protected $locale;

    public function getResults()
    {
        $param = $this->createParam($this->marketFilter);
        $param->setLocale($this->locale);

        $this->restoreDefaults();
        return $this->executeCustomQuery($param);
    }

    public function withMarketFilter(MarketFilter $filter)
    {
        $this->marketFilter = $filter;
        return $this;
    }

    public function withLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    private function restoreDefaults()
    {
        $this->marketFilter = null;
        $this->locale = null;
    }
}
