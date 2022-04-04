<?php


namespace App\Controller;

use App\Entity\JobCron;
use App\Form\Type\JobCronType;
use App\Repository\JobCronRepository;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class JobCronController extends AbstractController
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function createJobCron(Request $request, EntityManagerInterface $entityManager){
        $jobCron = new JobCron();
        $form = $this->createForm(JobCronType::class, $jobCron);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobCron);
            $entityManager->flush();

            return $this->redirectToRoute('Home');
        }

        return $this->render('createJobCron.html.twig', [
            'jobCron' => $jobCron,
            'form' => $form->createView(),
        ]);
    }


    public function readJobCron( JobCronRepository $repository,int $id){
        $job = $repository->findOneBySomeField($id);

        return $this->render('tousJobs.html.twig',['job'=>$job]);
    }


    public function updateJobCron(Request $request,int $id, JobCronRepository $repository)
    {
        $job = $repository->findOneBySomeField($id);
        $form = $this->createForm(JobCronType::class, $job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->manager;
            $em->persist($job);
            $em->flush();
            $this->addFlash('success', "un job cron a ete ajouté avec succes");
            //une redirection vers une autre page
            return $this->redirectToRoute('Home');
        }
    }



    public function delete( int $id, JobCronRepository $repository){
        $property = $repository->findOneBySomeField($id);
        $em =$this->manager;
        $em->remove($property);
        $em->flush();
        return  $this-> redirectToRoute('Home');
    }

    public function showAll(JobRepository $jobRepository){


        $job = $jobRepository->findAll();
        return $this->render('tous.html.twig',
            ['job'=>$job]
        );
    }
}