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
use Symfony\Component\Mailer\MailerInterface;

class saywow extends Command
{
    protected static $defaultName = 'app:saywow';
    private $mailer;
    private $logger;


    public function __construct(string $name = null,MailerInterface $mailer,LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
        parent::__construct($name);
    }


    protected function configure(): void
    {

    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            sleep(10);
            //$myfile = fopen("webdictionary.txt", "r");
            $output->writeln("wow wow");
            $log = "command name: app:saywow  state: success  execution date" . ' - ' . date("F j, Y, G:i") . PHP_EOL .
                "-------------------------" . PHP_EOL;
            file_put_contents('./var/log/saywow_succes' . date("y-m-d-G-i-s") . '.log', $log, FILE_APPEND);

        }
        catch(\Exception $exception){
            $log = "command name: app:saywow  state: error  error date" . ' - ' . date("F j, Y, G:i") . PHP_EOL .
                "error description : ".$exception.
                "-------------------------" . PHP_EOL;
            file_put_contents('./var/log/saywow_error' . date("y-m-d-G-i-s") . '.log', $log, FILE_APPEND);

            $email = new MailerController();
            $email->sendEmail($this->mailer, "Un erreur dans l'exécution du job dont la commande est app:saywow");

        }


        // $this->logger->info("Greeted: succes");
        //            $email = new MailerController();
        //            $email->sendEmail($this->mailer, "can't say hello world properly");
        //



        return(1);
    }
}
