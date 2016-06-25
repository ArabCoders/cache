# Cache Handler

A Base Cache handler that abstract away all the drivers/adapters differences
under common Interface, it can be have many drivers.

## Install

Via Composer

```bash
$ composer require arabcoders/cache
```

## Usage Example.

```php
<?php

require __DIR__ . '/../../autoload.php';

$adapter = new \arabcoders\cache\Adapters\Redis( [
    'port'      => 6379,
    'server'    => '127.0.0.1'
]);

$cache = new \arabcoders\cache\Cache( $adapter );

$cache->set( 'test', 'foo', 120 );

echo $cache->get('test')->getValue();
```
