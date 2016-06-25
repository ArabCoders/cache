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
    Interfaces\Cache as CacheInterface, Interfaces\Adapter, Interfaces\BaseAdapter, Interfaces\CacheItem
};

/**
 * Adapters Handler.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
Class Cache implements CacheInterface, BaseAdapter
{
    /**
     * @var Adapter
     */
    private $driver;

    /**
     * @var string
     */
    private $prefix = '';

    public function __construct( Adapter $driver, $prefix = '' )
    {
        $this->driver = $driver;

        $this->prefix = $prefix;
    }

    public function set( $key, $value, $ttl = null, array $options = [ ] ): bool
    {
        $key = ( array_key_exists( 'noprefix', $options ) ) ? $key : $this->prefix . $key;

        return $this->driver->set( $key, $value, $ttl, $options );
    }

    public function get( $key, array $options = [ ] ): CacheItem
    {
        $key = ( array_key_exists( 'noprefix', $options ) ) ? $key : $this->prefix . $key;

        return $this->driver->get( $key, $options );
    }

    public function exists( $key, array $options = [ ] ): bool
    {
        $key = ( array_key_exists( 'noprefix', $options ) ) ? $key : $this->prefix . $key;

        return $this->driver->exists( $key, $options );
    }

    public function delete( $key, array $options = [ ] ): bool
    {
        $key = ( array_key_exists( 'noprefix', $options ) ) ? $key : $this->prefix . $key;

        return $this->driver->delete( $key, $options );
    }

    public function getAdapter(): Adapter
    {
        return $this->driver;
    }

    public function getDriver()
    {
        return $this->driver->getDriver();
    }
}