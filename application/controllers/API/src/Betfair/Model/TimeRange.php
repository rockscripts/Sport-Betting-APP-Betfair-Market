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

class TimeRange extends BetfairSerializable
{
    protected $from;

    protected $to;

    public function __construct(\DateTime $from, \DateTime $to)
    {
        $this->setWithFormat($from, $to, "Y-m-d\TH:i:s\Z");
    }
    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    private function setWithFormat($from, $to, $format)
    {
        $this->from = $from !== null ? $from->format($format) : null;
        $this->to = $to !== null ? $to->format($format) : null;
    }

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
            if ($value !== null) {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}
