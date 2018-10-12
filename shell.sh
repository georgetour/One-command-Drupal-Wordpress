#!/bin/bash

#Project folder from directory variable and the url will be my-project.localhost:9100
directory="myproject"
user_name="yourusername"
project_port=9100

#Create drupal files with composer
composer create-project georgetour/drupal-composer-docker-workflow $directory --stability dev --no-interaction

#Create sync directories so you don't get error in linux
mkdir "$directory"/config && mkdir "$directory"/config/sync

#Add user to your config folder
chown $user_name "$directory"/config -R

#Enter created folder
cd $directory


#Change values to env file so they can be used by docker-compose
sed 's/myproject/'$directory'/' .env.example > .env
sed -i 's/9100/'$project_port'/' .env

#Create the host for drupal
docker-compose up -d




