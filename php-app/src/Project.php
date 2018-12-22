<?php namespace Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

class Project extends Command
{
    
    public function configure()
    {
        $this -> setName('create')
            -> setDescription('Greet a user based on the time of the day.')
            -> setHelp('This command allows you to greet a user based on the time of the day...')
            -> addArgument('project', InputArgument::REQUIRED, 'Drupal or Wordpress.');
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this -> createProject($input, $output);
    }
}