#!/bin/bash

#Take projectName variable from php
projectName="$projectName"
projectName+="_app"

#Create the app directory which will have all our project files
mkdir app

#Create the docker containers
docker-compose up -d

#Access container app and run composer 
docker exec $projectName composer create-project georgetour/drupal-dependencies /app --stability dev --no-interaction

#Create config sync needed later from drupal
docker exec -ti $projectName sh -c "mkdir -p /app/config/sync"

#Add correct ownership else the site won't run with current apache configuration
docker exec -ti $projectName sh -c "chown -R www-data:www-data /app/web"



#Add user and site with drush so you don't have to enter them in drupal's blue screen
docker exec $projectName drush site-install -y \
   --db-url=mysql://drupal:drupal@db:3306/drupal \
   --site-name=$projectName \
   --site-mail=admin@admin.com \
   --account-mail=admin@yahoo.gr \
   --account-name=admin \
   --account-pass=admin


