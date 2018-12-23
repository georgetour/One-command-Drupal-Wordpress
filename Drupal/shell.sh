#!/bin/bash

#Create the app directory which will have all our project files
mkdir app

#Create the docker containers
docker-compose up -d

#Access bash as root and create drupal project and files
docker exec -ti five_app sh -c "composer create-project drupal-composer/drupal-project:8.x-dev /app --stability dev --no-interaction"

#Create config sync needed later from drupal
docker exec -ti five_app sh -c "mkdir -p /app/config/sync"

#Add correct ownership else the site won't run with current apache configuration
docker exec -ti five_app sh -c "chown -R www-data:www-data /app/web"


