# One command docker/wordpress

One command to create a drupal or wordpress workflow. 

With one command you will have the files, the containers for the server, the site up and running along with phpmyadmin.

# Requirements
- php
- composer (for drupal only)
- git
- wget (or anything you like so you can download the phar file from here)
- docker
- command line 

# Installation (only once)
1. First download the phar file that has the application
```
wget https://github.com/georgetour/drupal-wordpress-docker/blob/master/app/ocd.phar
```

2. Move the application so you can run it and change permissions
```
sudo mv ocd.phar /usr/local/bin/ocd
sudo chmod 755 /usr/local/bin/ocd
```
# One command
### For drupal-project
```
ocd create drupal-project myproject 9100
```

### For wordpress-project (under construction)
```
ocd create wordpress-project myproject 9100
```

You just say ocd create then parameter drupal-project/wordpress-project projectname (gives containers names also) and port (use different ports).

# That's it!

## View your new site at local
http://myproject.localhost:9100/

## View phpMyAdmin 
http://pma.myproject.localhost:9100/

## Creds
### For drupal and phpMyAdmin
- database name: drupal
- database username: drupal
- password: drupal
- user root: root
- root password: password

<img src="various/creds-one-command.jpg">

### For wordpress and phpMyAdmin (under construction)
- database name: 
- database username: 
- password: 
- user root:
- root password: 


