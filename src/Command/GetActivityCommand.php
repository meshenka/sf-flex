<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Domain\LastSeen\UseCase\GetActivity;
use App\Domain\LastSeen\UseCase\Request\GetActivityRequest;

class GetActivityCommand extends Command
{
    protected static $defaultName = 'app:lastseen';

    /** @var GetActivity */
    private $getActivityUseCase;

    public function __construct(GetActivity $getActivityUseCase)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->getActivityUseCase = $getActivityUseCase;
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

        $useCaseRequest = new GetActivityRequest($user);
        $response = $this->getActivityUseCase->execute($useCaseRequest);

        if ($response->isKnowned()) {

            $io->writeln(sprintf(
                'last seen %s <info>(online: %s)</info> <comment>(lastseen: %s)</comment> ',
                $response->getId(),
                $response->isOnline() ? 'true' : 'false',
                $response->getLastSeen()->format(\DateTime::RFC3339)
            ));

            $io->success('Done');
            return;
        }

        $io->warning(sprintf(
            'user %s unknowned',
            $response->getId()
        ));

    }
}
