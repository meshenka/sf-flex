<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Domain\LastSeen\UseCase\Request\AddActivityRequest;
use App\Domain\LastSeen\UseCase\AddActivity;
use App\Domain\LastSeen\UseCase\GetActivity;
use App\Domain\LastSeen\UseCase\Request\GetActivityRequest;
use App\Command\Formatter\GetActivityResponseFormatter;

class AddactivityCommand extends Command
{
    protected static $defaultName = 'app:addactivity';
    
    private $addActivityUseCase;
    private $getActivityUseCase;

    public function __construct(AddActivity $addActivityUseCase, GetActivity $getActivityUseCase)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->addActivityUseCase = $addActivityUseCase;
        $this->getActivityUseCase = $getActivityUseCase;

        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setDescription('Update activity for a user')
            ->addArgument('user', InputArgument::REQUIRED, 'User ID')
            ->addArgument('lastseen', InputArgument::OPTIONAL, 'A Date, now if argument not set. Ex "2000-01-01"')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $user = $input->getArgument('user');
        $dateString = $input->getArgument('lastseen');

        $date = new \DateTime($dateString);  //will produce now if $dateString is null
    
        $useCaseRequest = new AddActivityRequest($user, $date);
        $this->addActivityUseCase->execute($useCaseRequest);
        $response = $this->findUser($user);
        $response = new GetActivityResponseFormatter($response);

        $io->writeln(sprintf(
            'last seen %s <info>(online: %s)</info> <comment>(lastseen: %s)</comment>',
            $response->getId(),
            $response->isOnline(),
            $response->getLastSeen()
        ));
     
        $io->success('Done!');
    }

    private function findUser(string $userId)
    {
        $useCaseRequest = new GetActivityRequest($userId);
        $response = $this->getActivityUseCase->execute($useCaseRequest);

        return $response;
    }
}
