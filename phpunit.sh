#!/bin/sh

symfony console d:d:c --env=test --if-not-exists
symfony console d:m:m --env=test -n
symfony console d:f:l --env=test -n --group=AppFixtures

if [ "$1" == "coverage" ]
then
   symfony php ./vendor/bin/phpunit --testdox --coverage-html var/log/test/test-coverage
else
   symfony php ./vendor/bin/phpunit --testdox
fi

echo Removing database
symfony console d:d:d -f --env=test -n 
echo Database removed