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

use arabcoders\cache\Exceptions\CacheException;

/**
 * Adapter Interface
 *
 * @author  Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface Adapter extends BaseAdapter
{
    /**
     * Constructor
     *
     * @param array $options
     *
     * @throws CacheException
     */
    public function __construct( array $options = [ ] );

    /**
     * Get Driver.
     *
     * @return mixed
     */
    public function getDriver();
}