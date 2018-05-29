<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\Tests;


class ResponseServiceMock
{
    public static function getJsonRpcBetfairGenericaResponse()
    {
       $json  = <<< JSON
{
   "jsonrpc": "2.0",
   "result": [
      {
         "eventType": {
            "id": "468328",
            "name": "Handball"
         },
         "marketCount": 59
      },
      {
         "eventType": {
            "id": "1",
            "name": "Soccer"
         },
         "marketCount": 14792
      },
      {
         "eventType": {
            "id": "2",
            "name": "Tennis"
         },
         "marketCount": 51
      },
      {
         "eventType": {
            "id": "3",
            "name": "Golf"
         },
         "marketCount": 12
      },
      {
         "eventType": {
            "id": "4",
            "name": "Cricket"
         },
         "marketCount": 139
      },
      {
         "eventType": {
            "id": "5",
            "name": "Rugby Union"
         },
         "marketCount": 100
      },
      {
         "eventType": {
            "id": "6",
            "name": "Boxing"
         },
         "marketCount": 12
      },
      {
         "eventType": {
            "id": "7",
            "name": "Horse Racing"
         },
         "marketCount": 187
      },
      {
         "eventType": {
            "id": "8",
            "name": "Motor Sport"
         },
         "marketCount": 3
      },
      {
         "eventType": {
            "id": "7524",
            "name": "Ice Hockey"
         },
         "marketCount": 8
      },
      {
         "eventType": {
            "id": "10",
            "name": "Special Bets"
         },
         "marketCount": 30
      },
      {
         "eventType": {
            "id": "451485",
            "name": "Winter Sports"
         },
         "marketCount": 7
      },
      {
         "eventType": {
            "id": "7522",
            "name": "Basketball"
         },
         "marketCount": 559
      },
      {
         "eventType": {
            "id": "1477",
            "name": "Rugby League"
         },
         "marketCount": 3
      },
      {
         "eventType": {
            "id": "4339",
            "name": "Greyhound Racing"
         },
         "marketCount": 269
      },
      {
         "eventType": {
            "id": "2378961",
            "name": "Politics"
         },
         "marketCount": 19
      },
      {
         "eventType": {
            "id": "6231",
            "name": "Financial Bets"
         },
         "marketCount": 51
      },
      {
         "eventType": {
            "id": "998917",
            "name": "Volleyball"
         },
         "marketCount": 69
      },
      {
         "eventType": {
            "id": "998919",
            "name": "Bandy"
         },
         "marketCount": 2
      },
      {
         "eventType": {
            "id": "998918",
            "name": "Bowls"
         },
         "marketCount": 10
      },
      {
         "eventType": {
            "id": "3503",
            "name": "Darts"
         },
         "marketCount": 446
      },
      {
         "eventType": {
            "id": "72382",
            "name": "Pool"
         },
         "marketCount": 1
      },
      {
         "eventType": {
            "id": "6422",
            "name": "Snooker"
         },
         "marketCount": 3
      },
      {
         "eventType": {
            "id": "6423",
            "name": "American Football"
         },
         "marketCount": 86
      },
      {
         "eventType": {
            "id": "7511",
            "name": "Baseball"
         },
         "marketCount": 1
      }
   ],
   "id": 1
}
JSON;
        return $json;

    }

} 