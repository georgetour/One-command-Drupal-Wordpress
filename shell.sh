#!/bin/bash

clear

directory="new-project"
user_name="yourname"

composer create-project georgetour/drupal-composer-docker-workflow $directory 2.* --no-interaction

mkdir "$directory"/config && mkdir "$directory"/config/sync

chown $user_name "$directory"{config} -R

cd $directory

docker-compose up




