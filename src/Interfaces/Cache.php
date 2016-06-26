<?php
/**
 * This file is part of {@see \arabcoders\cache} package.
 *
 * (c) 2013-2016 Abdulmohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\cache\Interfaces;

use \arabcoders\cache\Interfaces\Adapter as AdapterInterface;

/**
 * Cache Interface
 *
 * @package    arabcoders\cache
 * @author     Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface Cache extends BaseAdapter
{
    /**
     * Constructor
     *
     * @param AdapterInterface $driver Driver Handler
     * @param string           $prefix prefix for keys.
     */
    public function __construct( AdapterInterface $driver, $prefix = '' );

    /**
     * Exposes the Underlying Driver.
     *
     * @return mixed
     */
    public function getDriver();

    /**
     * Exposes the Underlying Handler.
     *
     * @return AdapterInterface
     */
    public function getAdapter(): AdapterInterface;
}