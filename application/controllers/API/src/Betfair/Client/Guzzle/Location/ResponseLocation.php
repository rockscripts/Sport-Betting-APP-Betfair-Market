<?php
namespace Betfair\Client\Guzzle\Location;

use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Command\Guzzle\ResponseLocation\AbstractLocation;
use GuzzleHttp\Command\Guzzle\ResponseLocation\ResponseLocationInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Class ResponseLocation
 * Return the entire Response Object
 * @package Betfair\Client\Guzzle\Location
 */
class ResponseLocation extends AbstractLocation implements ResponseLocationInterface
{
    public function __construct($locationName)
    {
        parent::__construct($locationName);
    }

    public function visit(
        CommandInterface $command,
        ResponseInterface $response,
        Parameter $param,
        &$result,
        array $context = []
    ) {
        $result = $response;
    }
}
