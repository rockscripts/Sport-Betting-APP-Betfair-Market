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

abstract class PriceData
{
    const SP_AVAILABLE = "SP_AVAILABLE";
    const SP_TRADED = "SP_TRADED";
    const EX_BEST_OFFERS = "EX_BEST_OFFERS";
    const EX_ALL_OFFERS = "EX_ALL_OFFERS";
    const EX_TRADED = "EX_TRADED";

    public static function getAll()
    {
        return array(
            self::SP_AVAILABLE,
            self::SP_TRADED,
            self::EX_BEST_OFFERS,
            self::EX_ALL_OFFERS,
            self::EX_TRADED,
        );
    }
}
