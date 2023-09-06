# selective/config

A strictly typed configuration component for PHP. Inspired by [Apache Commons Configuration](https://commons.apache.org/proper/commons-configuration/).

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/config.svg)](https://packagist.org/packages/selective/config)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://github.com/selective-php/config/workflows/build/badge.svg)](https://github.com/selective-php/config/actions)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/selective-php/config.svg)](https://scrutinizer-ci.com/g/selective-php/config/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/selective-php/config.svg)](https://scrutinizer-ci.com/g/selective-php/config/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/config.svg)](https://packagist.org/packages/selective/config/stats)


## Requirements

* PHP 8.1+

## Installation

```bash
composer require selective/config
```

## Theory of Operation

You can use the `Configuration` to read single values from a multidimensional 
array by passing the path to one of the `get{type}()` and `find{type}()` methods. 

Each `get*() / find*()` method takes a default value as second argument.
If the path cannot be found in the original array, the default is used as return value.

A `get*()` method returns only the declared return type. 
If the default value is not given and the element cannot be found, an exception is thrown.

A `find*()` method returns only the declared return type or `null`. 
No exception is thrown if the element cannot be found.

## Usage

```php
<?php

use Selective\Config\Configuration;

$config = new Configuration([
    'key1' => [
        'key2' => [
            'key3' => 'value1',
        ]
    ]
]);

// Output: value1
echo $config->getString('key1.key2.key3');
```

## Slim 4 integration

Add this dependency injection container definition:

```php
use Selective\Config\Configuration;

// ...

return [
    // Application settings
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },
    
    // ...
];
```

## Examples

### Configuring a database connection

The settings:

```php
// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => 'root',
    'database' => 'test',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ],
];
```

The container definition:

```php
use Selective\Config\Configuration;
use PDO;

return [
    // ...

    PDO::class => static function (ContainerInterface $container) {
        $config = $container->get(Configuration::class);

        $host = $config->getString('db.host');
        $dbname =  $config->getString('db.database');
        $username = $config->getString('db.username');
        $password = $config->getString('db.password');
        $charset = $config->getString('db.charset');
        $flags = $config->getArray('db.flags');
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        return new PDO($dsn, $username, $password, $flags);
    },

    // ...

];
```

### Injecting the configuration

The settings:

```php
$settings['module'] = [
    'key1' => 'my-value',
];
```

The consumer class:

```php
<?php

namespace App\Domain\User\Service;

use Selective\Config\Configuration;

final class Foo
{
    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function bar()
    {
        $myKey1 = $this->config->getString('module.key1');
        
        // ...
    }
}

```

## Similar libraries

* https://github.com/laminas/laminas-config
* https://github.com/hassankhan/config

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
