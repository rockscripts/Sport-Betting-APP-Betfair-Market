betfair-php
===========
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a44b7517-9af2-4651-8c45-6c75ef94ca1d/mini.png)](https://insight.sensiolabs.com/projects/a44b7517-9af2-4651-8c45-6c75ef94ca1d) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/danieledangeli/betfair-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/danieledangeli/betfair-php/?branch=master)

[![Latest Stable Version](https://poser.pugx.org/erlangb/betfair/v/stable.png)](https://packagist.org/packages/erlangb/betfair)
[![Total Downloads](https://poser.pugx.org/erlangb/betfair/downloads.png)](https://packagist.org/packages/erlangb/betfair)
[![Latest Unstable Version](https://poser.pugx.org/erlangb/betfair/v/unstable.png)](https://packagist.org/packages/erlangb/betfair)
[![License](https://poser.pugx.org/erlangb/betfair/license.png)](https://packagist.org/packages/erlangb/betfair)
[![Monthly Downloads](https://poser.pugx.org/erlangb/betfair/d/monthly.png)](https://packagist.org/packages/erlangb/betfair)
[![Daily Downloads](https://poser.pugx.org/erlangb/betfair/d/daily.png)](https://packagist.org/packages/erlangb/betfair)


**Protip:** There was big chnages in the last days, please use the version 0.1.1 instead of dev-master for back compatibility.
Have a look on:
[`erlangb/betfair`](https://packagist.org/packages/erlangb/betfair)
page to choose a stable version to use, instead of dev-master

This PHP 5.4+ library helps you to interact with the Betfair API via PHP.
Menù
------------
* [Main](README.md)

Installation
===========

This library can be found on [Packagist](https://packagist.org/packages).
The recommended way to install this is through [composer](http://getcomposer.org).

Run these commands to install composer, the library and its dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar require erlangb/betfair-php:dev-master
```

Or edit `composer.json` and add:

```json
{
    "require": {
        "erlangb/betfair": "dev-master"
    }
}
```

**Protip:** you should browse the
[`erlangb/betfair`](https://packagist.org/packages/erlangb/betfair)
page to choose a stable version to use, instead of dev-master

And install dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

Now you can add the autoloader, and you will have access to the library:

```php
<?php

require 'vendor/autoload.php';
```

Usage
======

Obtain an APP_KEY
------------
To use this library you have to obtain an APP_KEY from [Betfair](https://developer.betfair.com/)

Obtain a Betfair Object
------------

*  By using the factory interface

```php

use Betfair\BetfairFactory;
require 'vendor/autoload.php';

$betfair = BetfairFactory::createBetfair(
        $appKey,
        $username,
        $pwd,
        array()
    );

```

The last parameters are the options, which you can customize the Betfair object.
The following options are available:
*  __loginEndpoint__: array('loginEndpoint' => 'https://identitysso.betfair.it/api/login') to change the login endpoint
*  __responseAdapter__: array('responseAdapter' => new ArrayAdapter()) to change the response adapter
  *  The available adapters are:
    *  ArrayAdapter
    *  ArrayRpcAdapter
    *  JsonRpcAdapter

**Protip:** You can also implement your own *Adapter* by implement the *AdapterInterface* and pass it as an option

Query the Betfair API with the helpers objects.
------------
Once you got a *Betfair* object you can query the Betfair API.

There are several ways to do that.

The simplest one is just to use the available helpers methods.
For instance, if you want to get all the events "filtered by event type ids" you can simply:

```php
require 'vendor/autoload.php';

$eventBetfairHelper = $betfair->getBetfairEvent();
$eventBetfairHelper->getAllEventFilteredByEventTypeIds(array(1,2));
```

The available helpers are:

*  $betfair->getBetfairEvent();
*  $betfair->getBetfairEventType();
*  $betfair->getBetfairCompetition();
*  $betfair->getBetfairCountry();
*  $betfair->getBetfairMarketBook();
*  $betfair->getBetfairMarketCatalogue();
*  $betfair->getBetfairMarketType();
*  $betfair->getClearedOrder();
*  $betfair->getCurrentOrder();
*  $betfair->getVenues();

**Protip:**  With the __simple usage__ you can have access to the already existing helpers. Please feel free to contribute to this library by adding more helpers.

If an helper method is not present, you can simply use the object by specifying the parameters to execute a custom query:


```php
$seriaACompetition = 81;

$betfairEvent = $betfair->getBetfairEvent();

$marketFilter = MarketFilter::create()
    ->setTextQuery("Lazio")
    ->setCompetitionIds(array($seriaACompetition));

$betfairEvent->withMarketFilter($marketFilter);

$events = $betfairEvent->getResults();
```

If an object doesn't require a Betfair Market Filter, you can simply specify the __Param__:

```php
$betfair = BetfairFactory::createBetfair(
        $appKey,
        $username,
        $pwd
    );

$clearedOrder = $betfair->getBetfairClearedOrder();

$param = $clearedOrder->createParam();
$param->setBetStatus(BetStatus::SETTLED);

$clearedOrder->withParam($param);

$results = $clearedOrder->getResults();
```

Query the Betfair API without the helpers
------------

If in any case you want to query the API without using the helpers you can just use the "api" function on the Betfair object:

```php
public function api(ParamInterface $param, $method);
```

It will accept a __Param__ and a method name (listEevents, listMarketCatalogue ...)

To Obtain a __Param__ object just use the proper factory:

```php
$param = Param::create();
```

if you want to add a market filter to the Param Object, just use the factory and then set it as following:

```php
$marketFilter = MarketFilter::create();
$param->setMarketFilter($marketFilter);
```

Both __Param__ and __MarketFilter__ object have a list of methods to set the properties in a "builder" style:

```php

$marketFilter = MarketFilter::create()
    ->setEventIds(array($events))
    ->setCompetitionIds(array($competitions))
    ->setBspOnly(true)
    ->setInPlayOnly(true);

```

Read carefully the Betfair documentation API to use the proper properties with these objects.

How to contribute
===========

I'm very glad to be helped to maintain and extend this library.
Please feeling free to clone the repository and collaborate with me.

Reporting Issues
------------

I would love to hear your feedback. Report issues using the [Github
Issue Tracker](https://github.com/danieledangeli/betfair-php/issues) or email me at
[dangeli88.daniele@gmail.com](mailto:dangeli88.daniele@gmail.com).


Todo
===========
The library is actually "in dev" state and a lot of things to be done.
*   ~~Enabling guzzle library~~
*   Implements more "Betfairs objects" to extend the API
*   ~~Add more PHPspec test~~
*   ~~PHPspec test refactoring~~
*   ~~Handling login or app key errors in array and json RPC adapters (result is not set)~~
*   ~~Integration tests after the last changes~~
*   Add more betfair Account API helpers
*   Release first stable version
