# Automatic workflow for creating drupal project with composer and docker

This project will help you create a drupal environment. It will have useful modules generally used in Drupal sites and docker for the environment needed to run your site locally.

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

### Step 2 Download the shell script:
Download the ```shell.sh``` file where you will have your projects from here https://raw.githubusercontent.com/georgetour/drupal-composer-docker-workflow/master/shell.sh . 


### Step 3 Run the script 
Change the variables in the script according to your project and port you want to use. Type:

 ```
 ./shell.sh
 ```

 If you have problems with permissions chmod +x ```shell.sh```. 

 Wait for some minutes according to machine and you are ready to go!

 You can have many projects by just changing the port and directory.

#### ---TODO---
Maybe make use of one port for all projects.
Create automatically empty drupal theme and gulp.
