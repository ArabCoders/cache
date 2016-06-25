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
 * Base Adapter Interface.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface BaseAdapter
{
    /**
     * Set Cache.
     *
     * @param string $key
     * @param string $value
     * @param int    $ttl
     * @param array  $options
     *
     * @throws CacheException
     *
     * @return bool
     */
    public function set( $key, $value, $ttl = null, array $options = [ ] ): bool;

    /**
     * Get Cache.
     *
     * @param string $key     Key
     * @param array  $options Options
     *
     * @return CacheItem
     */
    public function get( $key, array $options = [ ] ): CacheItem;

    /**
     * Check if Cache exists.
     *
     * @param string $key     Key
     * @param array  $options Options
     *
     * @return bool
     */
    public function exists( $key, array $options = [ ] ): bool;

    /**
     * Delete Cache.
     *
     * @param string $key     Key
     * @param array  $options Options
     *
     * @throws CacheException
     *
     * @return bool
     */
    public function delete( $key, array $options = [ ] ): bool;
}