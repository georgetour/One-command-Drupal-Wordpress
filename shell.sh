#!/bin/bash

clear

directory="testing-new"
user_name="george"

composer create-project georgetour/drupal-composer-docker-workflow $directory --stability dev --no-interaction

mkdir "$directory"{/config} && mkdir "$directory"{/config/sync}

chown $user_name "$directory"{config} -R

cd $directory

docker-compose up




