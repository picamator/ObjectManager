ObjectManager
=============

[![PHP 7 ready](http://php7ready.timesplinter.ch/picamator/ObjectManager/dev/badge.svg)](https://travis-ci.org/picamator/ObjectManager)
[![Latest Stable Version](https://poser.pugx.org/picamator/object-manager/v/stable.svg)](https://packagist.org/packages/picamator/object-manager)
[![License](https://poser.pugx.org/picamator/object-manager/license.svg)](https://packagist.org/packages/picamator/object-manager)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/fe0853b9-7842-47bc-9460-da9bc407a9b7/mini.png)](https://insight.sensiolabs.com/projects/fe0853b9-7842-47bc-9460-da9bc407a9b7)

Master
------
[![Build Status](https://travis-ci.org/picamator/ObjectManager.svg?branch=master)](https://travis-ci.org/picamator/ObjectManager)
[![Coverage Status](https://coveralls.io/repos/github/picamator/ObjectManager/badge.svg?branch=master)](https://coveralls.io/github/picamator/ObjectManager?branch=master)

Dev
---
[![Build Status](https://travis-ci.org/picamator/ObjectManager.svg?branch=dev)](https://travis-ci.org/picamator/ObjectManager)
[![Coverage Status](https://coveralls.io/repos/github/picamator/ObjectManager/badge.svg?branch=dev)](https://coveralls.io/github/picamator/ObjectManager?branch=dev)

Object Manager is one class tool to build objects supplied with a Singleton wrapper and unit test stub helper. 

The main usage are:
 
 * refactoring legacy code with unit-testable style without break backwards compatibility
 * having one place for creating new instances

Installation
------------
Update to your `composer.json` with:

```json
{
    "require": {
        "picamator/object-manager": "~1.0"
    }
}
```

Requirements
------------
* [PHP 5.6](http://php.net/manual/en/migration56.new-features.php) or [PHP 7.0](http://php.net/manual/en/migration70.new-features.php)

Examples
--------

### Legacy
Let's application has an ``UserRepository``:

```php
<?php
class UserRepository 
{
    private $connection;
    
    public function __construct() 
    {
        $this->connection = new Connection();    
    }
}
```

The ``Connection`` instance here was created inside constructor make it hard to [mock](https://en.wikipedia.org/wiki/Mock_object) for unit testing.

One of the solution to keep backward compatibility is using ``ObjectManagerSingleton``:

```php
<?php
class UserRepository 
{
    private $connection;
    
    public function __construct() 
    {
        $this->connection = ObjectManagerSingleton::getInstance()->create();    
    }
}
```

Inside unit test before running the test needs to stub ``ObjectManagerSingleton`` with mock ``ObjectManagerSingleton::setInstance($mockObjectManager)``.
Having such is open the door for mocking ``Connection`` class.

Please follow [link](docs/example/Legacy) to find example source and unit test for them.

### Factory
Let's application has a ``ConnectionFactory``:

```php
<?php
class ConnectionFactory 
{
    public function create() 
    {
        return new Connection();
    }
}

```

With ``ObjectManager`` it can be rewritten to:

```php
<?php
class ConnectionFactory 
{
    private $objectManager;
    
    private $className;
    
    public function __construct(ObjectManager $objectManager, $className = 'Connection') 
    {
        $this->objectManager = $objectManager;
        $this->className = $className;
    } 
    
    public function create() 
    {
        return $this->objectManager->create($this->className);
    }
}

```
As a result it's possible to use Dependency Injection to override ``$className`` with new implementation.
With PHP 7 features ``ConnectionFactory`` would look like:

```php
<?php
declare(strict_types=1);

class ConnectionFactory 
{
    private $objectManager;
    
    private $className;
    
    public function __construct(ObjectManager $objectManager, string $className = 'Connection') 
    {
        $this->objectManager = $objectManager;
        $this->className = $className;
    } 
    
    public function create() : ConnectionInterface
    {
        return $this->objectManager->create($this->className);
    }
}

```

Please follow [link](docs/example/Factory) to find example source and unit test for them.

### Statistics
Suppose application needs to collect objects statistics without using any additional tools.
The solution might be ``ObjectManager`` overriding with injection in development environment.

Please follow [link](docs/example/Statistics) to find example source and unit test for them.

Documentation
-------------
* [UML class diagram](docs/uml/class.diagram.png)
* [Usage examples](docs/example)

Developing
----------
To configure developing environment please:

1. Follow [Docker installation steps](bin/docker/README.md)
2. Run inside Docker container `composer install`

Contribution
------------
To start helping the project please review [CONTRIBUTING](CONTRIBUTING.md).

License
-------
ObjectManager is licensed under the MIT License. Please see the [LICENSE](LICENSE.txt) file for details.
