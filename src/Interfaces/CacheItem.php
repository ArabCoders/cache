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

/**
 * Cache item Interface.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface CacheItem
{
    /**
     * constructor
     *
     * @param string $key
     * @param null   $value
     * @param bool   $isHit
     * @param int    $ttl
     */
    public function __construct( string $key, $value = null, $isHit = true, $ttl = 0 );

    /**
     * Get the key associated with this CacheItem
     *
     * @return string
     */
    public function getKey(): string;

    /**
     * Obtain the value of this cache item
     *
     * @return mixed
     */
    public function getValue();

    /**
     * This boolean value tells us if our cache item is currently in the cache or not
     *
     * @return boolean
     */
    public function isHit(): bool;

    /**
     * Obtain the expiration time of the cached item.
     *
     * @return int [0 unkown, -1 expired, int expiration date].
     */
    public function getTTL(): int;
}