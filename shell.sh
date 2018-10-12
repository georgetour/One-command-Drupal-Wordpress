#!/bin/bash

#Project folder from directory variable and the url will be my-project.localhost:9100
directory="my-project"
user_name="yourname"
project_port=9100

#Create drupal files with composer
composer create-project georgetour/drupal-composer-docker-workflow $directory --stability dev --no-interaction

#Create sync directories so you don't get error in linux
mkdir "$directory"/config && mkdir "$directory"/config/sync

#Add user to your project folder
chown $user_name "$directory"/config -R

#Enter created folder
cd $directory

#Change values to env file so they can be used by docker-compose
sed 's/myproject/'$directory'/' .env.example > .env
sed 's/9100/'$project_port'/' .env.example > .env

#Run the host for drupal
docker-compose up -d



