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

use arabcoders\cache\
{
    CacheItem,
    Interfaces\Adapter,
    Exceptions\CacheException
};

/**
 * APC Adapter.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class APC implements Adapter
{
    /**
     * @var int default TTL.
     */
    public $ttl = 120;

    /**
     * @var array user APC information.
     */
    private $user = [ ];

    public function __construct( array $options = [ ] )
    {
        if ( !extension_loaded( 'apc' ) )
        {
            throw new CacheException( 'APC: Extension is not installed, http://pecl.php.net/package/apcu' );
        }
    }

    public function set( $key, $value, $ttl = null, array $options = [ ] ): bool
    {
        if ( !apc_store( $key, $value, ( ( $ttl ) ? $ttl : $this->ttl ) ) )
        {
            throw new CacheException( 'Unable to store cache' );
        }

        $this->__resetTTLInfo();

        return true;
    }

    public function get( $key, array $options = [ ] )
    {
        $exists = false;
        $value  = apc_fetch( $key, $exists );

        if ( array_key_exists( 'string', $options ) )
        {
            return $value;
        }

        return new CacheItem( $key, $value, ( ( $exists == true ) ? true : false ), $this->__apcGetTtl( $key ) );
    }

    public function exists( $key, array $options = [ ] )
    {
        return apc_exists( $key );
    }

    public function delete( $key, array $options = [ ] )
    {
        if ( !apc_delete( $key ) )
        {
            throw new CacheException( 'Unable to delete cache.' );
        }

        $this->__resetTTLInfo();

        return true;
    }

    private function __resetTTLInfo()
    {
        $this->user = apc_cache_info( 'user' );
    }

    private function __apcGetTtl( $key )
    {

        if ( empty( $this->user['cache_list'] ) )
        {
            return 0;
        }

        foreach ( $this->user['cache_list'] as $entry )
        {
            if ( $entry['info'] != $key )
            {
                continue;
            }

            if ( $entry['ttl'] == 0 )
            {
                return -1;
            }

            return $entry['creation_time'] + $entry['ttl'];
        }

        return 0;
    }

    public function getDriver()
    {
        return '';
    }
}