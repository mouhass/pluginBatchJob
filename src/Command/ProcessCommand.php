<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class ProcessCommand extends Command
{


    protected static $defaultName = 'process_bg';


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$phpBinaryFinder = new PhpExecutableFinder();


        while ($pr->isRunning()) {

            $ps = new Process(sprintf('php bin/console %s', "app:saywow"));
            $ps->setWorkingDirectory(__DIR__ . '/../..');

            $ps->start();

            while ($ps->isRunning()) {
                $output->write('.');

            }
            $output->writeln('');

            if ( ! $ps->isSuccessful()) {
                $output->writeln('Error app:saywow!!!');

                return -1;
            }



            exit();
        }
        $output->writeln('');

        if ( ! $pr->isSuccessful()) {
            $output->writeln('Error app:saygoodbye!!!');

            return -1;
        }

        $output->writeln('Job finished');

        return 1;
    }

}
