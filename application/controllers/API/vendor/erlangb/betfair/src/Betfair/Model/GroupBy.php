<?php

namespace Betfair\Model;

/**
 * EVENT_TYPE
A roll up of settled P&L, commission paid and number of bet orders, on a specified event type
EVENT
A roll up of settled P&L, commission paid and number of bet orders, on a specified event
MARKET
A roll up of settled P&L, commission paid and number of bet orders, on a specified market
SIDE
An averaged roll up of settled P&L, and number of bets, on the specified side of a specified selection within a specified market, that are either settled or voided
BET
The P&L, commission paid, side and regulatory information etc, about each individual bet order
 * Class GroupBy
 * @package Betfair\Model
 */
abstract class GroupBy
{
    const EVENT_TYPE = "EVENT_TYPE";
    const EVENT = "EVENT";
    const MARKET = "MARKET";
    const SIDE = "SIDE";
    const BET = "BET";

    public static function getAll()
    {
        return array(
            self::EVENT_TYPE,
            self::EVENT,
            self::MARKET,
            self::SIDE,
            self::BET
        );
    }
}
