
# PHP OOP License Application - Case study
The intention of this project was to highlight Oriented Object Programming concepts in PHP

In this case study you will see how to prevent SQL Injection & CSFR attack



### Installation

$ git clone https://github.com/crystinutzaa/php-oop-licence


Database script: https://github.com/crystinutzaa/php-oop-licence/blob/master/config/sql/licence.sql

Create database "license" and import the MySql schema

mysql -u [user] -p [password] license < licence.sql


### Configure DB connection
Go to: /config/config.php and change the DB username, password & dsn


### Run
http://localhost/php-oop-licence


### Test - Codeception

Acceptance Tests, Functional Tests and Unit Tests

$ ./vendor/bin/codecept run --steps

Acceptance tests: Edit the file tests/acceptance.suite.yml and change the URL to
http://localhost/php-oop-licence


### Author
Soponar Cristina - <crystinutzaa@gmail.com> 

