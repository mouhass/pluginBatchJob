<?php

// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Controller\MailerController;
use App\Entity\Historique;
use App\Repository\JobCronRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Mailer\MailerInterface;

class saywow extends Command
{
    protected static $defaultName = 'app:saywow';
    private $mailer;
    private $logger;
   private $kernel;
   private $manager;
   private $repository;

    public function __construct(string $name = null,MailerInterface $mailer,LoggerInterface $logger,KernelInterface  $kernel,EntityManagerInterface $manager,JobCronRepository $repository)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->kernel = $kernel;
        $this->manager = $manager;
        $this->repository = $repository;
        parent::__construct($name);
    }


    protected function configure(): void
    {   $this
        ->addArgument('Related_job', InputArgument::OPTIONAL, 'Whitch one this command is related to?');

    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            sleep(10);
            // $output->writeln("wow wow");
            //$myfile = fopen("webdictionary.txt", "r");
            $output->writeln("wow wow");
            $log = "command name: app:saywow  state: success  execution date" . ' - ' . date("F j, Y, G:i") . PHP_EOL .
                "-------------------------" . PHP_EOL;
            file_put_contents($this->kernel->getProjectDir().'/var/log/saywow_succes' . date("y-m-d-G-i-s") . '.log', $log, FILE_APPEND);

            $historique = new Historique();
            $historique->setCreatedAt(new \DateTime());
            $historique->setPath('/var/log/saywow_succes' . date("y-m-d-G-i-s") . '.log');
            $jobCron = $this->repository->findElementById($input->getArgument('Related_job'));
            $historique->setJobCronHist($jobCron);
           $this->manager->persist($historique);
            $this->manager->flush();
            }
        catch(\Exception $exception){
            $log = "command name: app:saywow  state: error  error date" . ' - ' . date("F j, Y, G:i") . PHP_EOL .
                "error description : ".$exception.
                "-------------------------" . PHP_EOL;
            file_put_contents('../var/log/saywow_error' . date("y-m-d-G-i-s") . '.log', $log, FILE_APPEND);

            $historique = new Historique();
            $historique->setCreatedAt(new \DateTime());
            $historique->setPath('/var/log/saywow_error' . date("y-m-d-G-i-s") . '.log');
            $jobCron = $this->repository->findElementById($input->getArgument('Related_job'));
            $historique->setJobCronHist($jobCron);
            $this->manager->persist($historique);
            $this->manager->flush();

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
