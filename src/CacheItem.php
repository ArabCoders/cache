<?php
/**
 * This file is part of {@see \arabcoders\cache} package.
 *
 * (c) 2013-2016 Abdulmohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\cache;

use arabcoders\cache\
{
    Interfaces\CacheItem as CacheItemInterface
};

/**
 * Cache Item.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class CacheItem implements CacheItemInterface
{
    /**
     * @var string
     */
    private $key = '';

    /**
     * @var bool
     */
    private $isHit = false;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var int
     */
    private $ttl = 0;

    public function __construct( string $key, $value = null, $isHit = true, $ttl = 0 )
    {
        $this->key   = $key;
        $this->value = $value;
        $this->isHit = $isHit;
        $this->ttl   = $ttl;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isHit(): bool
    {
        return $this->isHit;
    }

    public function getTTL(): int
    {
        return $this->ttl;
    }
}