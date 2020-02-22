# One command docker/wordpress

One command to create a drupal or wordpress workflow. 

With one command you will have the files, the containers for the server, the site up and running along with phpmyadmin.

# Requirements
- php
- composer (for drupal only)
- git
- wget
- docker
- command line 

# Installation (only once)
1. First download the phar file that has the application
```
wget https://github.com/georgetour/One-command-Drupal-Wordpress/raw/master/app/ocd.phar
```

2. Move the application so you can run it and change permissions
```
sudo mv ocd.phar /usr/local/bin/ocd
sudo chmod 755 /usr/local/bin/ocd
```

3. Create an external nginx reverse proxy that will handle the domains locally.
```
git clone https://github.com/georgetour/nginx-proxy.git
```

Inside the folder:
```
docker-compose up -d
```

# One command
### For drupal-project
```
ocd create drupal-project myproject 
```

### For wordpress-project (under construction)
```
ocd create wordpress-project myproject
```

You just say ocd create then parameter drupal-project/wordpress-project projectname (gives containers names also).

# That's it!

### Don't forget to add your site at hosts file. If your site is myproject.dd add in your hosts: 
- 127.0.0.1 myproject.dd pma.myproject.dd

## View your new site at local
http://myproject.dd

## View phpMyAdmin 
http://pma.myproject.dd

## Creds
### For drupal and phpMyAdmin
- database name: drupal
- database username: drupal
- password: drupal
- user root: root
- root password: password
- host: db

<img src="various/creds-one-command.jpg">

### For wordpress and phpMyAdmin (under construction)
- database name: 
- database username: 
- password: 
- user root:
- root password: 


