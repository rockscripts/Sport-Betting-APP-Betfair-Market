<?php

namespace Betfair\Model;

/**
 * Class MarketSort
 * @package Betfair\Model
 */
abstract class MarketSort
{
    const MINIMUM_TRADED    = "MINIMUM_TRADED";
    const MAXIMUM_TRADED    = "MAXIMUM_TRADED";
    const MINIMUM_AVAILABLE = "MINIMUM_AVAILABLE";
    const MAXIMUM_AVAILABLE = "MAXIMUM_AVAILABLE";
    const FIRST_TO_START    = "FIRST_TO_START";
    const LAST_TO_START     = "LAST_TO_START";
}
