# TrackTik PHP DEVELOPER EVALUATION

## Setup

The project has been developed with the following prerequisites.
The code will work though to any PHP server with version 7.4.
Docker has been used here, but it is not necessary to use Docker.
Composer is required.

### Prerequisites

1. Operating system: Linux Ubuntu
2. Docker
3. Zip extension and unzip command

## Download the files
Go to following folder and clone the project from git, 
or download the files and move them there:

`var/www`

It is important the root of the project is:

`var/www/php-developer-evaluation`

### Docker compose
If Docker is not installed already, please follow the instructions per distro:
For Ubuntu as an example: https://docs.docker.com/engine/install/ubuntu/

With Docker installed, at the root folder, execute:

`docker-compose up`

### Composer
At the root of the project, enter the container PHP-FPM with:

`docker-compose exec php-fpm bash`

Go to the root path:

`var/www/php-developer-evaluation` with `cd /var/www/php-developer-evaluation`

Install Composer using the instructions here:

https://getcomposer.org/download/

Or copy and paste the following at the console:

`php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"`

After the successful installation of composer in our docker PHP-FPM container,
let's execute to install the dependencies:

`php composer.phar install`

Note: It is possible you will see an error at the composer install like this:

`The zip extension and unzip command are both missing, skipping.`

Please execute the following inside the container:

`apt update`

`apt install zip unzip`

And then try againg the composer install.

## Use

### Console

At the root of the project, enter the container PHP-FPM with:

`docker-compose exec php-fpm bash`

Go to the root path:

`var/www/php-developer-evaluation` with `cd /var/www/php-developer-evaluation`

Execute the symfony console command:

`php console app:auto-question1-question2`

### PHPUnit

At the root of the project, enter the container PHP-FPM with:

`docker-compose exec php-fpm bash`

Go to the root path:

`var/www/php-developer-evaluation` with `cd /var/www/php-developer-evaluation`

Execute the tests:

`php vendor/bin/phpunit tests/ElectronicItemTest.php`

`php vendor/bin/phpunit tests/ElectronicItemsTest.php`