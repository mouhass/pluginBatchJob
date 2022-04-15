<?php

namespace App\MessageHandler;

use App\Message\LogCommand;
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

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;

    }

    public function __invoke(LogCommand $command,KernelInterface $kernel)
    {
       echo "test 2";
       sleep(10);
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput(array(
            'command' => $command->getNameCommand(),

        ));

        // Use the NullOutput class instead of BufferedOutput.
        $output = new BufferedOutput();

        $application->run($input, $output);

        $content = $output->fetch();



    }


}
