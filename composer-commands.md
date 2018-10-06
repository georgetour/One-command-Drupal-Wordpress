### Composer

    1. Composer is a Dependency Manager for php like npm for node etc.
    2. Composer is used by drupal core.
    3. All modules may be downloaded using it.
    4. Some modules and libraries require it like commerce.
You will be amazed how many stuff you can do with it from the command line!

Install composer
wget https://getcomposer.org/download/1.6.5/composer.phar
mv composer.phar /usr/local/bin/composer
chmod 755 /usr/local/bin/composer

https://getcomposer.org/

### Commands

``` php  composer```

Shows a list of all available composer commands.

``` php composer init ```

It will create a composer.json file by asking some questions and let you find the dependencies you want.

``` php composer install ```

It read composer.json file and downloads all the composer.json files and puts them in vendor directory.
php composer update
Always reads composer.json and updates composer.lock with new libraries and versions. You can also update specific library.

``` php composer require ```

Search for specific library and add it to composer.json. It will also run the update command to download the library.

### install vs update
https://stackoverflow.com/questions/33052195/what-are-the-differences-between-composer-update-and-composer-install

Never run update in production server.

### Composer.json
Composer needs a composer.json file. You can create one in github and link it in packagist.org. Packagist.org is composers official site that has packages.
The lock file is important if you have multiple developers so each person has identical vendor libraries.

Autoload.php
To use classes from something we have download we need to include vendor autoload.php in our project.

require __DIR__.’/../../../../vendor/autoload.php’

Maybe you need to have the require in settings.php file which runs first of all.
require __DIR__.’/../../vendor/autoload.php’

### VERSIONS IMPORTANT!
Sometimes a version might break something. For example drush version 9.4.0 had some issues. 
drush/drush": "^9.3.0",
The ^ means if newer version exists find it. So in the above command since the version 9.4.0 exists it will replace 9.3.0. So you have to write exactly the version you want
"drush/drush": "9.3.0",

### Composer and private repositories

Composer can manage private PHP components whose repositories require authentication.
When you run composer install or composer update , Composer prompts you if a
component’s repository requires authentication credentials. Composer also asks if you
want to save the repository authentication credentials in a local auth.json file (created
adjacent to the composer.json file). An example auth.json file looks like this:
``` 
{
    "http-basic": {
        "example.org": {
        "username": "your-username",
        "password": "your-password"
        }
    }
} 
```

Add composer manually credentials

``` composer config http-basic.example.org your-username your-password ```

By default, this command saves credentials in the current project’s auth.json
file.


