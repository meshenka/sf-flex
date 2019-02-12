<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Domain\LastSeen\UseCase\GetLastSeen;
use App\Domain\LastSeen\UseCase\Request\GetLastSeenRequest;

class LastseenCommand extends Command
{
    protected static $defaultName = 'app:lastseen';

    private $getLastSeenUseCase;

    public function __construct(GetLastSeen $getLastSeen)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->getLastSeenUseCase = $getLastSeen;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('find when a user has been last seen')
            ->addArgument('user', InputArgument::REQUIRED, 'user identifier')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $user = $input->getArgument('user');

        $useCaseRequest = new GetLastSeenRequest($user);
        $response = $this->getLastSeenUseCase->execute($useCaseRequest);

        // @todo refactor to avoid this horror
        $lastSeen = ($response->getLastSeen() instanceof \DateTime) ? $response->getLastSeen()->format('Y-m-d H:i:s') : 'false';

        $io->writeln(sprintf('last seen %s <info>(online: %s)</info> <comment>(lastseen: %s)</comment>',
            $user, 
            $response->isOnline()? 'true': 'false',
            $lastSeen
        ));

        $io->success('Done');
    }
}
