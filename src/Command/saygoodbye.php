<?php

// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Controller\MailerController;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Mailer\MailerInterface;

class saygoodbye extends Command
{
    protected static $defaultName = 'app:saygoodbye';
    private $mailer;
    private $logger;
    private $kernel;


    public function __construct(string $name = null,MailerInterface $mailer,LoggerInterface $logger,KernelInterface $kernel)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->kernel = $kernel;
        parent::__construct($name);
    }


    protected function configure(): void
    {

    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            sleep(70);
            //$output->writeln("goodbye goodbye");
//            //$myfile = fopen("webdictionary.txt", "r");
            $output->writeln("goodbye goodbye");
            $log = "command name: app:saygoodbye  state: success  execution date" . ' - ' . date("F j, Y, G:i") . PHP_EOL .
                "-------------------------" . PHP_EOL;
            file_put_contents($this->kernel->getProjectDir().'/var/log/saygoodbye_succes' . date("y-m-d-G-i-s") . '.log', $log, FILE_APPEND);

        }
        catch(\Exception $exception){
            $log = "command name: app:saygoodbye  state: error  error date" . ' - ' . date("F j, Y, G:i") . PHP_EOL .
                "error description : ".$exception.
                "-------------------------" . PHP_EOL;
            file_put_contents($this->kernel->getProjectDir().'/var/log/saygoodbye_error' . date("y-m-d-G-i-s") . '.log', $log, FILE_APPEND);

            $email = new MailerController();
            $email->sendEmail($this->mailer, "Un erreur dans l'exécution du job dont la commande est app:saygoodbye");

        }


        // $this->logger->info("Greeted: succes");
        //            $email = new MailerController();
        //            $email->sendEmail($this->mailer, "can't say hello world properly");
        //



        return(1);
    }
}
