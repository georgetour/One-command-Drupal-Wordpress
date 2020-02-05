<?php
/**
* This class will be used to create a new Drupal project according to input parameter given
*/

namespace Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Project;

class DrupalProject {
  public $projectName;
  public $port;
  public $whereTo = '../projects/';
  

  //When we use new Drupal
  public function __construct($projectName, $port)
  {
    $this -> createDrupalProject($projectName, $port);
  }

  public function createDrupalProject($projectName, $port) {
    
    //1. Install drupal files
    $this->shell("composer create-project georgetour/drupal-project:8.x-dev " . $projectName . " --stability dev --no-interaction"); 
    echo "\n - Finsihed downloading drupal files - \n \n" ;

    //2 . Download docker files
    $this->shell("git clone https://github.com/georgetour/drupal-docker.git");
    
    //3. Move docker files and remove folder
    $this->shell("rm -rf drupal-docker/.git");
    $this->shell("mv -f drupal-docker/* " . $projectName . "/");
    $this->shell("rm -rf drupal-docker");
    echo "\n - Finsihed downloading docker files and creating docker containers for server - \n \n" ;
    
    //4. Change env file according to parameters and rm it
    // Get current file
    $file = $projectName. '/.env';
   
    //Clear existing text
    file_put_contents($file, "");
    $current = "PROJECT_NAME=" .$projectName . "\n" .
    "PROJECT_BASE_URL=". $projectName .".localhost\n" .
    "PROJECT_PORT=" . $port . "\n" .
    "DB_HOST=db" . "\n" .
    "DB_NAME=drupal" . "\n" .
    "DB_USER=drupal" . "\n" .
    "DB_PASSWORD=drupal" . "\n" .
    "DB_ROOT_PASSWORD=password" . "\n" ;

    //Put correct values for variables according to input
    file_put_contents($file, $current);

    // //5. Run docker and create environement
    $this->shell("cd " .$projectName. " && docker-compose up -d");

    echo ("\n - Created docker containers and server is running - \n \n");

    //5. Install drupal with drush
    // exec("cd ") .$projectName . "&& drush site-install -y --db-url=mysql:drupal:drupal@db:3306/drupal --site-name=" . $projectName .
    // " --site-mail=admin@admin.com --account-mail=admin@yahoo.gr --account-name=admin --account-pass=admin"
    
    //6. Add empty theme and sass
  }

  //Prints to shell.
  //
  protected function shell($command) {
    $process = new Process($command);
    $process->setTimeout(0);
    $process->run(function ($type, $buffer) {
      echo $buffer;
    });
  }
}
