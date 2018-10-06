## Execute the lemp stack
docker-compose up -d

##Access database in command line
docker-compose exec mysql bash

###Create database
mysql -u root -p
TYPE MYSQL PASSWORD: admin

Now create a new database:

create database currentproject;

## Access phpmyadmin
user root
password admin
localhost:8183

## Dump the database from command line

$ docker exec [MYSQL_CONTAINER] /usr/bin/mysqldump -u [MYSQL_USER] --password=[MYSQL_PASSWORD] [MYSQL_DATABASE] > backup.sql.gz
