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

abstract class MarketProjection
{
    const COMPETITION = "COMPETITION"; //If not selected then the competition will not be returned with marketCatalogue
    const EVENT = "EVENT"; //If not selected then the event will not be returned with marketCatalogue
    const EVENT_TYPE = "EVENT_TYPE"; //If not selected then the eventType will not be returned with marketCatalogue
    const MARKET_START_TIME = "MARKET_START_TIME"; //If not selected then the start time will not be returned with marketCatalogue
    const MARKET_DESCRIPTION = "MARKET_DESCRIPTION"; //If not selected then the description will not be returned with marketCatalogue
    const RUNNER_DESCRIPTION = "RUNNER_DESCRIPTION";// not selected then the runners will not be returned with marketCatalogue
    const RUNNER_METADATA = "RUNNER_METADATA";//If not selected then the runner metadata will not be returned with marketCatalogue. If selected then RUNNER_DESCRIPTION will also be returned regardless of whether it is included as a market projection.

    public static function getAll()
    {
        return array(
            self::COMPETITION,
            self::EVENT,
            self::EVENT_TYPE,
            self::MARKET_START_TIME,
            self::MARKET_DESCRIPTION,
            self::RUNNER_DESCRIPTION,
            self::RUNNER_METADATA
        );
    }
}
