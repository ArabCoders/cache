<?php
/**
 * This file is part of {@see \arabcoders\cache} package.
 *
 * (c) 2013-2016 Abdulmohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\cache\Adapters;

use \RedisException,
    \Redis as RedisClient;

use arabcoders\cache\
{
    CacheItem,
    Interfaces\Adapter,
    Exceptions\CacheException
};

/**
 *  Redis Adapter.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class Redis implements Adapter
{
    /**
     * @var int default TTL.
     */
    public $ttl = 120;

    /**
     * @var \Redis Redis Instance.
     */
    protected $redis;

    /**
     *  Class Constructor.
     *
     * @param array $options
     *
     * @throws CacheException when redis extension is not loaded.
     */
    public function __construct( array $options = [ ] )
    {
        $options['port']   = array_key_exists( 'port', $options ) ? $options['port'] : 6379;
        $options['server'] = array_key_exists( 'server', $options ) ? $options['server'] : '127.0.0.1';

        if ( !extension_loaded( 'redis' ) )
        {
            throw new CacheException( 'Redis: Extension is not installed, http://pecl.php.net/package/redis' );
        }

        try
        {
            $this->redis = new RedisClient();

            $this->redis->connect( $options['server'], $options['port'] );

            if ( !empty( $options['auth'] ) )
            {
                $this->redis->auth( $options['auth'] );
            }
        }
        catch ( RedisException $e )
        {
            throw new CacheException( $e->getMessage(), $e->getCode(), $e->getPrevious() );
        }
    }

    public function set( $key, $value, $ttl = null, array $options = [ ] ): bool
    {
        $ttl = ( is_null( $ttl ) ) ? $this->ttl : $ttl;

        if ( !$this->redis->set( $key, $value, $ttl ) )
        {
            throw new CacheException( sprintf( 'Unable to store cache - %s', $this->redis->getLastError() ) );
        }

        return true;
    }

    public function get( $key, array $options = [ ] ): CacheItem
    {
        $value = $this->redis->get( $key );

        return new CacheItem( $key, $value, $this->redis->exists( $key ), $this->redis->ttl( $key ) );
    }

    public function exists( $key, array $options = [ ] ): bool
    {
        return $this->redis->exists( $key );
    }

    public function delete( $key, array $options = [ ] ): bool
    {
        if ( !$this->exists( $key ) )
        {
            return false;
        }

        if ( !$this->redis->del( $key ) )
        {
            throw new CacheException( 'Unable to delete cache.' );
        }

        return true;
    }

    /**
     * Get Driver.
     *
     * @return RedisClient
     */
    public function getDriver()
    {
        return $this->redis;
    }
}