<?php

namespace Betfair\Model;

abstract class Side
{
    const LAY = "LAY";
    const BACK = "BACK";

    public static function getAll()
    {
        return array(
            self::LAY,
            self::BACK
        );
    }
}
