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
  
  //When we use new Drupal
  public function __construct($projectName)
  {
    $this -> createDrupalProject($projectName);
  }

  public function createDrupalProject($projectName) {
    
    //1. Install drupal files
    $this->shell("composer create-project georgetour/drupal-project " . $projectName . " --stability dev --no-interaction"); 
    echo "\n - Finsihed downloading drupal files - \n \n" ;

    //2. Add lemp-docker if not exists
    try {
      if(!file_exists(realpath("lemp-docker/docker-compose.yml"))) {
        $this->shell("git clone https://github.com/georgetour/lemp-docker.git");
        $this->shell("rm -rf lemp-docker/.git");
      }
    } catch (\Throwable $th) {
      echo "Error getting lemp-docker from git";
    }

    //3. Copy docker files so we can docker-compose up -d later
    $this->shell("cp -r lemp-docker/* " . $projectName);
    $this->shell("cp lemp-docker/example.env ". $projectName . "/.env");
    echo "\n - Finsihed downloading docker server files - \n \n" ;
    
    //4. Change env file according to parameters and rm it
    // Get current file
    $file = $projectName. '/.env';
   
    //Clear existing text
    file_put_contents($file, "");
    $current = "PROJECT_NAME=" .$projectName . "\n" .
    "PROJECT_URL=". $projectName .".dd\n" .
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
    
    //6. Add site to hosts file
    echo ("\n - Add ".$projectName . ".dd " . "and pma." .$projectName . ".dd to hosts file - \n \n");
    echo ("\n - Visit your site at http://" .$projectName . ".dd".  "- \n \n");

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
