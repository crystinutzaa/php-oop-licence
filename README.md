
# PHP OOP License Application - Case study
The intention of this project was to highlight Oriented Object Programming concepts in PHP

In this case study you will see how to prevent SQL Injection & CSFR attack



### Installation

$ git clone https://github.com/crystinutzaa/php-oop-licence


Database script: https://github.com/crystinutzaa/php-oop-licence/blob/master/config/sql/licence.sql

Create database "license" and import the MySql schema

mysql -p -u[user] license < license.sql


### Run
http://localhost/


### Test - Codeception

Acceptance Tests, Functional Tests and Unit Tests

$ ./vendor/bin/codecept run --steps


### Author
Soponar Cristina - <crystinutzaa@gmail.com> 

