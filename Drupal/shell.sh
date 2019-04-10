#!/bin/bash

#Take projectName variable from php and add user for ownership
projectFolder="$projectName"
projectFolder+="_app"
projectName="$projectName"
user="george"

#Create the app directory which will have all our project files
mkdir app

#Create the docker containers
docker-compose up -d

#Add drupal console launcher in our container
docker exec $projectFolder curl https://drupalconsole.com/installer -L -o drupal.phar
docker exec $projectFolder mv drupal.phar /usr/local/bin/drupal  
docker exec $projectFolder chmod +x /usr/local/bin/drupal

# #Access container app and run composer 
docker exec $projectFolder composer create-project georgetour/drupal-project:8.x-dev /app --stability dev --no-interaction

# #Get empty theme, put it in themes folder and unzip it
docker exec $projectFolder wget https://github.com/georgetour/dw-docker/raw/master/Drupal/gt.zip
docker exec $projectFolder mv gt.zip web/themes
docker exec -ti $projectFolder sh -c "cd web/themes && unzip gt.zip"
docker exec -ti $projectFolder sh -c "rm web/themes/gt.zip" 

# #Create config sync needed later from drupal
docker exec -ti $projectFolder sh -c "mkdir -p /app/config/sync"

# #Add correct ownership else the site won't run with current apache configuration
docker exec -ti $projectFolder sh -c "chown -R www-data:www-data /app/web"

# #Add user and site with drush so you don't have to enter them in drupal's blue screen
docker exec $projectFolder drush site-install -y \
   --db-url=mysql://drupal:drupal@db:3306/drupal \
   --site-name=$projectName \
   --site-mail=admin@admin.com \
   --account-mail=admin@yahoo.gr \
   --account-name=admin \
   --account-pass=admin

# #Enable admin toolbar and dropdownmenu for drupal
docker exec -ti $projectFolder sh -c "drush en admin_toolbar -y && drush en admin_toolbar_tools -y"

# #If we don't run this everything will be for root user
sudo chown -R $user app 

# #Add our new app to localhost since mozilla doesn't automatic find it
echo '127.0.0.1 ' $projectName | sudo tee -a /private/etc/hosts


