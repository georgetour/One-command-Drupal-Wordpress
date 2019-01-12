<?php
/**
* This class will be used to create a new Wordpress project according to input parameter given
*/

namespace Console;

class WordpressProject {
  public $projectName;
  public $port;
  public $whereTo = '../projects/';
  

  public function __construct($projectName, $port)
  {
    $this -> createWordpressProject($projectName, $port);
  }

  public function createWordpressProject($projectName, $port) {
    //1 . Make the project foler
    mkdir($this-> projectFolder($projectName), 0755, true);
    chmod($this-> projectFolder($projectName), 0755);
    //2. Add the env file
    $this -> createEnvFile($projectName, $port);
    //3. Add docker files
    $this -> createDockerStack($projectName);
    //4. Create Wordpress files
    $this -> createWordpress($projectName);
  }

  //The path of the env file so you don't have to use this strange path
  public function envPath($projectName) {
    $this -> projectName = $projectName;

    return $this-> projectFolder($projectName). "/". ".env";
  }

  //Project folder so you don't repeat
  public function projectFolder($projectName) {
    $this -> projectName = $projectName;

    return $this-> whereTo .$projectName;
  }

  //Create the env file to new folder for our project
  public function createEnvFile($projectName, $port) {
    $this -> projectName = $projectName;
    $this -> port = $port;

    //Take the env file
    copy("../Wordpress/.env", $this -> envPath($projectName));

    //Changes according to user input
    $envText = file_get_contents($this -> envPath($projectName));
    $envText = str_replace("myproject", $projectName, $envText);
    $envText = str_replace(9100, $port, $envText);

    //Put the correct .env content into our folder
    file_put_contents($this -> envPath($projectName), $envText);
  }

  //Add docker files
  public function createDockerStack($projectName) {
    $this -> projectName = $projectName;

    copy("../Wordpress/apache-wordpress.conf", $this-> projectFolder($projectName) ."/apache-wordpress.conf" );
    copy("../Wordpress/docker-compose.yml", $this-> projectFolder($projectName) ."/docker-compose.yml" );
    copy("../Wordpress/Dockerfile", $this-> projectFolder($projectName) ."/Dockerfile" );
    copy("../Wordpress/shell.sh", $this-> projectFolder($projectName) ."/shell.sh" );
    exec("chmod 0755 " .$this-> projectFolder($projectName).  " -R");
  }

  //Create Wordpress project with files
  public function createWordpress($projectName) {
    $this -> projectName = $projectName;
 
    //Enter project folder
    chdir("".$this-> projectFolder($projectName). "/");

    //Pass the variable to shell script 
    putenv("projectName=$projectName");

    //Execute the script we took from Wordpress folder
    exec("./shell.sh $projectName");
  }
}
