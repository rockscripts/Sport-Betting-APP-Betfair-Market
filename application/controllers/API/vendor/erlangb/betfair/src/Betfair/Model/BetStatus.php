<?php

namespace Betfair\Model;

/**
 *
 * SETTLED
A matched bet that was settled normally
VOIDED
A matched bet that was subsequently voided by Betfair, before, during or after settlement
LAPSED
Unmatched bet that was cancelled by Betfair (for example at turn in play).
CANCELLED
Unmatched bet that was cancelled by an explicit customer action.
 *
 * Class BetStatus
 * @package Betfair\Model
 */
abstract class BetStatus
{
    const SETTLED = "SETTLED";
    const VOIDED = "VOIDED";
    const LAPSED = "LAPSED";
    const CANCELLED = "CANCELLED";

    public static function getAll()
    {
        return array(
            self::SETTLED,
            self::CANCELLED,
            self::CANCELLED,
            self::VOIDED
        );
    }
}
