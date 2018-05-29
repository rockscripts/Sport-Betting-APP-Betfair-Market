<?php

namespace Betfair\BettingApi;

use Betfair\AbstractBetfair;
use Betfair\Model\ParamInterface;

class BetfairParamObject extends AbstractBetfair
{
    protected $param;

    public function getResults()
    {
        $response = $this->executeCustomQuery($this->param);
        $this->restoreDefaults();
        return $response;
    }

    public function withParam(ParamInterface $param)
    {
        $this->param = $param;
        return $this;
    }

    private function restoreDefaults()
    {
        $this->param = null;
    }
}
