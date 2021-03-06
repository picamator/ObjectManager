Docker
======

Development environment has:

* object-manager-php: official [PHP 5.6 Docker](https://hub.docker.com/_/php/), [OpenSSH](https://www.openssh.com/), [Composer](https://getcomposer.org/)

Pre installation
----------------
Before start please be sure that was installed:

1. [Docker](https://docs.docker.com/engine/installation/)
2. [Compose](https://docs.docker.com/compose/install/)

Installation
------------
1. Set environment variable `HOST_IP` with your host machine IP, e.g. `export host_ip=192.168.0.104`
2. Run in application root `sudo docker-compose -f bin/docker/docker-compose.yml up`
3. Check containers `sudo docker-compose ps`

Containers
----------

### object-manager-php

#### SSH
SSH credentials:

1. user: `root`
2. password: `screencast`
3. ip: 0.0.0.0
4. port: 2240

To make connection via console simple run `ssh root@0.0.0.0 -p 2240`.

Usefull commands
----------------

* go to shell inside container `sudo docker-compose -f ./bin/docker/docker-compose.yml exec object-manager-php bash`
* build container `sudo docker-compose -f ./bin/docker/docker-compose.yml build object-manager-php`
* build container without caching `sudo docker-compose -f ./bin/docker/docker-compose.yml build --no-cache object-manager-php`

For more information please visit [Docker Compose Command-line Reference](https://docs.docker.com/compose/reference/).

Configuration IDE (PhpStorm)
---------------------------- 
### Remote interpreter
1. Use ssh connection to set php interpreter
2. PHP executable `/usr/local/bin/php`
3. Set "Path mappings": `host machine project root->/ObjectManager`

More information is [here](https://confluence.jetbrains.com/display/PhpStorm/Working+with+Remote+PHP+Interpreters+in+PhpStorm).

### UnitTests
1. Configure UnitTest using remote interpreter. 
2. Choose "Use Composer autoload"
3. Set "Path to script": `/ObjectManager/vendor/autoload.php`
4. Set "Default configuration file": `/ObjectManager/tests/phpunit.xml.dist`

More information is [here](https://confluence.jetbrains.com/display/PhpStorm/Running+PHPUnit+tests+over+SSH+on+a+remote+server+with+PhpStorm).
