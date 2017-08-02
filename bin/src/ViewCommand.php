<?php

namespace Make;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use Make\Make;

class ViewCommand extends Command{

	protected function configure(){
		$this->setName("make:view")
				->setDescription("Creates a vew folder in resources/views/ with 4 different views")
				->addArgument('viewName', InputArgument::REQUIRED, 'What is the name of the view folder you wish to create? View names must be plural and small caps. They should but not necessarily be the same with the name of the table in the database)');
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		
		$make = new Make();
		$input = $input->getArgument('viewName');


		if(preg_match('/[A-Z]/', $input)){
			 // There is atleast one uppercase letter
			 $output->writeln('Error: your view name cannot contain an upper case letter. Try putting everything in small cap' . $result);
			}else if( strpos( $input, "." ) !== false ) {
		   $output->writeln('Error: Your view name cannot contain a dot');
		}else{
				
		$result = $make->makeView($input);
		$output->writeln('4 views have been created in the resources/views/' . $input .' folder');

		}
			
			
		
	}

}
