# Automatic workflow for creating a drupal or wordpress project.

## Drupal

You will be able to work with drupal, composer, drush, gulp with sass and empty theme.

Php app that will create drupal or wordpress project

We will use the php symfony console application

The app will be in php-app

The command will be ./dwstart.php

The structure of the class 
must be 

namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MyCommand extends Command
{
    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...
    }
}

src folder will have our commands


