<?php

namespace Make;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use Make\Make;

class ControllerCommand extends Command{

	protected function configure(){
		$this->setName("make:controller")
				->setDescription("Creates a controller file in app/Controllers")
				->addArgument('controllerName', InputArgument::REQUIRED, 'What is the name of the controller you wish to create? Controller name must be capitalized and Plural with ending with the suffix Controller. eg. BooksController)');
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		
		$make = new Make();
		$input = $input->getArgument('controllerName');
		
		//confirm that the Controller name entered is formatted correctly
		
		//confirm that it contains the word controller
		if( strpos( $input, "Controller" ) == false ) {
		   $output->writeln('<error>Error: Your controller name is not named correctly. It should be in plural and should end with the word Controller. Eg. BooksController </error>');
		}else if($input{0} !== strtoupper($input{0})){
				//the first character does not start with an upper case
				$output->writeln('Error: Your controller name must start with a capital letter eg. BooksController');
			}else if( strpos( $input, "." ) !== false ) {
		   $output->writeln('<fg=red>Error: Your controller name cannot contain a dot. Here is an example of a good controller name : BooksController </>');
		}else{
			$result = $make->makeController($input);

		$output->writeln('<fg=green>Your controller has been created in app/Controllers/</>' . $input.'.php');
	
		}
		
		
	}

}
