# Automatic workflow for creating drupal project with composer and docker

This project will help you create a drupal environment. It is based in https://github.com/drupal-composer/drupal-project but will have useful modules generally used in Drupal sites and docker for the environment needed to run your site locally.

The current installation is for linux. Probably it will work in WSL and Mac with some changes.


## Usage

First you need to understand what composer is:

1. Composer is a Dependency Manager for php like npm for node etc.

2. Composer is used by drupal core.

3. All modules may be downloaded using it.

4. Some modules and libraries require it like commerce.

You will be amazed how many stuff you can do with it from the command line!

### Step 1 Install composer:
```
wget https://getcomposer.org/download/1.6.5/composer.phar
mv composer.phar /usr/local/bin/composer
chmod 755 /usr/local/bin/composer
```

### Step 2 Create drupal project:
This will create drupal folders will all files in public_html folder that was referenced in composer.json.

```
composer create-project georgetour/drupal-composer-docker-workflow some-dir --stability dev --no-interaction
```

### Step 3 Download docker-compose file:
This will have images for the server that will run our drupal site. It will contain nginx, mariadb, phpmyadmin

```
TODO
```
