<?php namespace Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

class Project extends Command
{
  //Important function that adds the arguments for our custom command
  public function configure(){
    $this -> setName('create') //How we will call our command
          -> setDescription('ex. create drupal-project myprojectname') //What our command will do
          -> setHelp('create drupal-project or wordpress-project project-name')
          -> addArgument('project', InputArgument::REQUIRED, 'Drupal or Wordpress.') //Get input argument
          -> addArgument('projectName', InputArgument::REQUIRED, 'Project Name.'); //Get input argument
  }

  //Creates the project according to input from Command.php
  public function execute(InputInterface $input, OutputInterface $output){
    $this -> createProject($input, $output);
  }
}