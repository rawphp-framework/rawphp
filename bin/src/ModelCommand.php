<?php

namespace Make;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use Make\Make;

class ModelCommand extends Command{

	protected function configure(){
		$this->setName("make:model")
				->setDescription("Creates a model file in app/Models")
				->addArgument('ModelName', InputArgument::REQUIRED, 'The name of the model - must be Camel Cased and Singular)');
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		
		$make = new Make();
		$input = $input->getArgument('ModelName');

		//Check if model name has a dot, throw error
	 if( strpos( $input, "." ) !== false ) {
		   $output->writeln('Error: Your model name cannot contain a dot. Example of a good model name: Book');
		} else if (strtolower($input[0]) == $input[0]){
			//the model name does not start with a capital letter
		
		   $output->writeln('Error: Your model name needs to start with a capital letter. Example of a good model name: Book ');	
		} else{
			$result = $make->makeModel($input);
		$output->writeln('Your model has been created in app/Models/' . $input.'php - here is the result '.$result);
		}
		
		

	}

}
