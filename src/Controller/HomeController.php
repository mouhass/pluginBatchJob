<?php

namespace App\Controller;

use App\Repository\JobCompositeRepository;
use App\Repository\JobCronRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="Home")
     */
     public function index(JobCronRepository $jobCronRepository, JobCompositeRepository $compositeRepository){

         return $this->render('tous.html.twig',
         ['nbreJobCronError'=> $jobCronRepository->calculateJobCronErr(),

             'nbreJobCompositeError'=>$compositeRepository->calculateJobCompErr(),
             'nbreJobCronEnCours'=>$jobCronRepository->calculateJobCronEnCours() ,

             'nbreJobCompositeEnCours'=>$compositeRepository->calculateJobCompEnCours()
             ]
         );
     }


}
