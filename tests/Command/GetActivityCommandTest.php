<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GetActivityommandTest extends KernelTestCase
{
    public function testNonExistingUser()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:lastseen');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            'user' => 'CommandTest'
        ]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('[WARNING] user CommandTest unknowned', $output);
    }
    public function testExistingUser()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:lastseen');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            'user' => '1@fixture.loc'
        ]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('last seen 1@fixture.loc', $output);
        $this->assertContains('last seen', $output);
    }

}