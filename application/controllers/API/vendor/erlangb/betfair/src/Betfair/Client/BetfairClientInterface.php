<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\Client;

use Betfair\Model\ParamInterface;

interface BetfairClientInterface
{
    public function apiNgRequest($operation, ParamInterface $param, $type = "betting");
    public function authenticateCredential();
}
