<?php namespace Console;

class DrupalProject {

  public function __construct($projectName)
  {
    $this -> createDrupalProject($projectName);
  }

  public function createDrupalProject($projectName) {
    mkdir('' . $projectName, 0777, true);
  }
}