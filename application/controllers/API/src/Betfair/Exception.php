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

/**
 * Common package exception interface to allow
 * users of caching only this package specific
 * exceptions thrown
 */
interface Exception
{
    /**
     * Following best practices for PHP5.3 package exceptions.
     * All exceptions thrown in this package will have to implement this interface
     *
     * @link http://wiki.php.net/pear/rfc/pear2_exception_policy
     */
}
