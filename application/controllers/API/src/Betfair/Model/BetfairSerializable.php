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

class BetfairSerializable implements \JsonSerializable
{
    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $array = array();
        $properties = get_object_vars($this);
        foreach ($properties as $key => $value) {
            if (null !== $value) {
                $array[$key] = $value;
            }
        }

        if (count($array) == 0) {
            return new \StdClass;
        }

        return $array;
    }
}
