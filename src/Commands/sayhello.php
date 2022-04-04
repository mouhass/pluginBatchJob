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

class sayhello extends ContainerAwareCommand
{
    protected static $defaultName = 'app:sayhello';
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


            $output->writeln("hello hello");

            $this->logger->info("Greeted: succes");

//            $email = new MailerController();
//            $email->sendEmail($this->mailer, "can't say hello world properly");
//



        return(1);
    }
}
