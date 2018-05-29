<?php
/**
 * Created by PhpStorm.
 * User: danieledangeli
 * Date: 15/02/15
 * Time: 20:46
 */

namespace Betfair\Model;

/**
 * Class MatchProjection
 * @package Betfair\Model
 */
abstract class MatchProjection
{
    const NO_ROLLUP = "NO_ROLLUP";
    const ROLLED_UP_BY_PRICE = "ROLLED_UP_BY_PRICE";
    const ROLLED_UP_BY_AVG_PRICE = "ROLLED_UP_BY_AVG_PRICE";
}
