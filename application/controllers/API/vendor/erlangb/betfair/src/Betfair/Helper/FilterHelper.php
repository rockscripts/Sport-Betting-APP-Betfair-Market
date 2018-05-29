<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\Helper;

class FilterHelper
{
    public static function getEmptyFilter()
    {
        return '{"filter":{}}';
    }

    public static function getFilterFillByParamArray($paramArray)
    {
        $json_array = array();

        foreach ($paramArray as $key => $value) {
            $json_array['filter'][$key] = $value;
        }

        return json_encode($json_array);
    }
}
