<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair;

use Betfair\AccountApi\AccountDetails;
use Betfair\AccountApi\AccountFunds;
use Betfair\Adapter\AdapterInterface;
use Betfair\Adapter\ArrayRpcAdapter;
use Betfair\BettingApi\MarketType\MarketType;
use Betfair\BettingApi\Order\ClearedOrder;
use Betfair\BettingApi\Order\CurrentOrder;
use Betfair\BettingApi\Venues\Venues;
use Betfair\Client\BetfairClientInterface;
use Betfair\BettingApi\Competition\Competition;
use Betfair\BettingApi\Country\Country;
use Betfair\BettingApi\Event\Event;
use Betfair\BettingApi\Event\EventType;
use Betfair\Factory\MarketFilterFactory;
use Betfair\Factory\ParamFactory;
use Betfair\BettingApi\MarketBook\MarketBook;
use Betfair\BettingApi\MarketCatalogue\MarketCatalogue;
use Betfair\BettingApi\TimeRange\TimeRange;
use Betfair\Model\ParamInterface;

class Betfair
{
    /**
     * Version.
     * @see http://semver.org/
     */
    const VERSION = '1.0.0-dev';

    /**
     * The adapter to use.
     *
     * @var AdapterInterface
     */
    protected $adapter;

    /** @var  BetfairClientInterface */
    protected $betfairClient;

    /** @var \Betfair\BetfairGeneric  */
    protected $genericBetfair;

    /** @var \Betfair\BetfairGeneric  */
    protected $paramFactory;

    /** @var \Betfair\Factory\MarketFilterFactory  */
    protected $marketFilterFactory;

    /** @var  BetfairGeneric */
    protected $betfairGeneric;

    public function __construct(
        BetfairClientInterface $client,
        AdapterInterface $adapter = null
    ) {
        $this->betfairClient = $client;
        $this->adapter = (null !== $adapter) ? $adapter : new ArrayRpcAdapter();
        $this->paramFactory = new ParamFactory();
        $this->marketFilterFactory = new MarketFilterFactory();
    }

    public function api(ParamInterface $param, $method)
    {
        $betfairGeneric = $this->getBetfairGeneric();
        return $betfairGeneric->executeCustomQuery($param, $method);
    }

    /**
     * @return BetfairGeneric
     */
    public function getBetfairGeneric()
    {
        $this->betfairGeneric = new BetfairGeneric($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
        return $this->betfairGeneric;
    }

    /**
     * @return EventType
     */
    public function getBetfairEventType()
    {
        return new EventType($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return Event
     */
    public function getBetfairEvent()
    {
        return new Event($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return MarketCatalogue
     */
    public function getBetfairMarketCatalogue()
    {
        return new MarketCatalogue($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return MarketBook
     */
    public function getBetfairMarketBook()
    {
        return new MarketBook($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return Country
     */
    public function getBetfairCountry()
    {
        return new Country($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return Competition
     */
    public function getBetfairCompetition()
    {
        return new Competition($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return TimeRange
     */
    public function getBetfairTimeRange()
    {
        return new TimeRange($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return MarketType
     */
    public function getBetfairMarketType()
    {
        return new MarketType($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return ClearedOrder
     */
    public function getBetfairClearedOrder()
    {
        return new ClearedOrder($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    /**
     * @return CurrentOrder
     */
    public function getBetfairCurrentOrder()
    {
        return new CurrentOrder($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    public function getVenues()
    {
        return new Venues($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    public function getBetfairAccountFunds()
    {
        return new AccountFunds($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }

    public function getBetfairAccountDetails()
    {
        return new AccountDetails($this->betfairClient, $this->adapter, $this->paramFactory, $this->marketFilterFactory);
    }
}
