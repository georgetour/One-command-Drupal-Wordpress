<?php 
/**
* This class will be used to control input from user and accordingly create drupal or wordpress project
*/

namespace Console;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Project;

class Command extends SymfonyCommand
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function createProject(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln([
          '**** Create Drupal or Wordpress project with docker by georgetour ****',
          '=========================================================================',
          '',
        ]);

        //Input arguments
        $project = $input -> getArgument('project');
        $projectName = $input -> getArgument('projectName');

        //Check input arguments and create accordingly the project
        if ($project == 'drupal-project') {
          if (!empty($projectName)) {
            $drupal = new DrupalProject($projectName);
          } else {
            $output -> writeln("Probably wrong project name or port is not a number");
          } 
        } else if ($project == 'wordpress-project'){          
          // if (!empty($projectName) && ctype_digit(strval($port))) {
          //   $wordpress = new WordpressProject($projectName, $port);
          // } else {
            $output -> writeln("wordpress test");
          // }
        } else {
          $output -> writeln("First argument must be drupal-project or wordpress-project.");
        }
    }
      /**
  * Prints to shell.
  */
  protected function shell($command) {
    $process = new Process($command);
    $process->setTimeout(0);
    $process->run(function ($type, $buffer) {
      echo $buffer;
    });
  }
}
