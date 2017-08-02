<?php

use Hash\HashCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

require_once  './vendor/autoload.php'; 

class HashCommandTest extends \PHPUnit_Framework_TestCase{

	public function testHashIsCorrect(){

		$application = new Application();
        $application->add(new HashCommand());

        $command = $application->find('Hash:Hash');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'      => $command->getName(),
            'Password'         => 'Sitepoint'
        ));	

		$this->assertRegExp('/Your password hashed:/', $commandTester->getDisplay());
	
	}

}
