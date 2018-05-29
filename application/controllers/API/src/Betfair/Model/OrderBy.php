<?php

namespace Betfair\Model;

/**
 * Class OrderBy
 * @package Betfair\Model
 */
abstract class OrderBy
{
    const BY_MARKET = "BY_PLACE_TIME";
    const BY_MATCH_TIME = "BY_PLACE_TIME";
    const BY_PLACE_TIME = "BY_PLACE_TIME";
    const BY_SETTLED_TIME = "BY_SETTLED_TIME";
    const BY_VOID_TIME = "BY_VOID_TIME";
}
