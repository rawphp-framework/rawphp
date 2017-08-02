<?php

namespace Hash;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use Hash\Hash;

class ConfirmCommand extends Command{

	protected function configure(){
		$this->setName("Hash:Confirm")
				->setDescription("Confirms an Hash given the string.")
				->addArgument('Password', InputArgument::REQUIRED, 'What password do you wish to confirm?)')
				->addArgument('Hash', InputArgument::REQUIRED, 'What is the hashyou want to confirm?');
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		
		$hash = new Hash();
		$inputPassword = $input->getArgument('Password');
		$inputHash = $input->getArgument('Hash');

		$result = $hash->checkHash($inputPassword, $inputHash);

		if($result){
			$output->writeln('The hash belongs to the password!');
			return true;
		}
		
		$output->writeln('The hash does not belong to the password!');

	}

}
