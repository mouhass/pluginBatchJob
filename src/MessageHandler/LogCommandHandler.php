<?php

namespace App\MessageHandler;

use App\Message\LogCommand;
use App\Repository\JobCronRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class LogCommandHandler  implements MessageHandlerInterface
{
    private $kernel;
    private $registry;
    public function __construct(KernelInterface $kernel,ManagerRegistry $registry)
    {
        $this->kernel = $kernel;
        $this->registry = $registry;
    }

    public function __invoke(LogCommand $command)
    {
        echo "test 2";
        sleep(10);

        $rep = new JobCronRepository($this->registry);
        $jobCron = $rep->commandPossesses($command->getNameCommand());
        exec("php bin/console ".$command->getNameCommand()." ".$command->getIdJobCron().' '.$command->getNomJobComposite().' '.$command->getDernierSousJob());
       echo "finished";

    }
}
