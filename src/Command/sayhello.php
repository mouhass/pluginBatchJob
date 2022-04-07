<?php

// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Controller\MailerController;
use App\Repository\JobCronRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Process\Process;

class sayhello extends Command
{
    protected static $defaultName = 'app:sayhello';
    private $mailer;
    private $logger;
    private $repository;
   const MAX_SIMULTANEOUS_PROCESSES = 50;

    public function __construct(string $name = null,MailerInterface $mailer,LoggerInterface $logger,JobCronRepository $repository)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->repository = $repository;
        parent::__construct($name);
    }


    protected function configure(): void
    {

    }
    protected function readJobs(JobCronRepository $repository){
        $jobs  = $repository->findAll();
        return $jobs;
    }

//    async protected function processArray(array) {
//      // map array to promises
//      const promises = array.map(delayedLog);
//      // wait until all promises are resolved
//      await Promise.all(promises);
//      console.log('Done!');
//    }
    protected function checkRunningProcesses(array $processes): array {
        foreach($processes as $i => $process) {
            if(!$process->isRunning()) {
                unset($processes[$i]);
            }
        }
        return $processes;
    }


     protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $app = $this->getApplication();
            $hello = $this->readJobs($this->repository);
            $myList=[];
            for($x=0;$x<=count($hello[$x])-1;$x++){
               $myList[$x] = 'php bin/console '.$hello[$x]->getScriptExec();
            }

               for ($x = 0; $x <= count($hello)-1; $x++) {

//                    $cleanRedisKeysCmd = $app->find($hello[$x]->getScriptExec());
//                    $cleanRedisKeysInput = new ArrayInput([]);
//                    $cleanRedisKeysCmd->run($cleanRedisKeysInput, $output);


////                    $output=$hello[$x]->getScriptExec();
////                    $retval=null;
////                   exec('php bin/console '.$hello[$x]->getScriptExec(),$output, $retval);
                    $process = new Process(sprintf('php bin/console %s', $hello[$x]->getScriptExec()));
                   $process->start();

            }
//            $process = new Process($myList);
//            $process->start();
//            while($process->isRunning()){}



        }
        catch(\Exception $exception){
            $log = "command name: app:sayhello  state: error  error date" . ' - ' . date("F j, Y, G:i") . PHP_EOL .
                "error description : ".$exception.
                "-------------------------" . PHP_EOL;
            file_put_contents('./var/log/sayhello_error' . date("y-m-d-G-i") . '.log', $log, FILE_APPEND);

            $email = new MailerController();
            $email->sendEmail($this->mailer, "Un erreur dans l'exécution du job dont la commande est app:sayhello");
            $output->writeln($exception);
        }


    // $this->logger->info("Greeted: succes");
    //            $email = new MailerController();
    //            $email->sendEmail($this->mailer, "can't say hello world properly");
    //



        return(1);
    }
}
