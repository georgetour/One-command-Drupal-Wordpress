<?php 
/**
* This class will be used to create a new Drupal project according to input parameter given
*/

namespace Console;

class DrupalProject {

  public $projectName;
  public $port;
  public $whereTo = '../projects/';


  public function __construct($projectName, $port)
  {
    $this -> createDrupalProject($projectName, $port);
  }

  public function createDrupalProject($projectName, $port) {
    //1 . Make the project foler
    mkdir($this-> whereTo . $projectName, 0775, true);
    //2. Add the env file
    $this -> createEnvFile($projectName, $port);
    //3. Add docker files
    $this -> createDockerStack($projectName);
  }

  //The path of the env file so you don't have to use this strange path
  public function envPath($projectName) {
    $this -> projectName = $projectName;

    return $this-> whereTo .$projectName. "/". ".env" ;
  }

  //Create the env file to new folder for our project
  public function createEnvFile($projectName, $port) {
    $this -> projectName = $projectName;
    $this -> port = $port;
    
    //Take the env file 
    copy("../Drupal/.env", $this -> envPath($projectName));

    //Changes according to user input
    $envText = file_get_contents($this -> envPath($projectName));
    $envText = str_replace("myproject", $projectName, $envText);
    $envText = str_replace(9100, $port, $envText);

    //Put the correct .env into our folder
    file_put_contents($this -> envPath($projectName), $envText);
  }

  //Add docker files
  public function createDockerStack($projectName) {
    $this -> projectName = $projectName;

    copy("../Drupal/apache-drupal.conf", $this-> whereTo .$projectName ."/apache-drupal.conf" );
    copy("../Drupal/docker-compose.yml", $this-> whereTo .$projectName ."/docker-compose.yml" );
  }
}