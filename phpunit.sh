#!/bin/sh

symfony console d:d:c --env=test --if-not-exists
symfony console d:m:m --env=test -n
symfony console d:f:l --env=test -n

php ./vendor/bin/phpunit