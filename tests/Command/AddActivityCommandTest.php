<?php

// tests/Command/CreateUserCommandTest.php
namespace App\Tests\Command;

use App\Command\AddactivityCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class AddActiityCommandTest extends KernelTestCase
{
    public function testWithoutDate()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:addactivity');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            'user' => 'new.1@phpunit'
        ]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('last seen new.1@phpunit', $output);
    }

    public function testWithDate()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:lastseen');
        $commandTester = new CommandTester($command);


        $date = new \DateTime();

        $commandTester->execute([
            'command'  => $command->getName(),
            'user' => 'new.2@phpunit',
            'date' => $date->format("Y-m-d H:i:s")
        ]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('last seen new.2@phpunit', $output);
        $this->assertContains($date->format('Y-m-d H:i:s'), $output);
    }

}