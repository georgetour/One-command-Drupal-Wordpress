#!/bin/bash

#Take projectName variable from php and add user for ownership
projectFolder="$projectName"
projectFolder+="_app"
projectName="$projectName"
user="youruser"

#Create the app directory which will have all our project files
mkdir app

#Create the docker containers
docker-compose up -d

#Get wordpress 4.9.8 
docker exec $projectFolder wget https://github.com/georgetour/dw-docker/raw/master/Wordpress/wordpress-4.9.8.zip

#Unzip wordpress
docker exec -ti $projectFolder sh -c "unzip wordpress-4.9.8.zip"
docker exec -ti $projectFolder sh -c "rm wordpress-4.9.8.zip" 

#Add correct ownership else the site won't run with current apache configuration
docker exec -ti $projectFolder sh -c "chown -R www-data:www-data /app"

#If we don't run this everything will be for root user
#sudo chown -R $user app

#Add our new app to localhost since mozilla doesn't automatic find it
echo '127.0.0.1 ' $projectName | sudo tee -a /private/etc/hosts
