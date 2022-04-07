<?php
namespace App\Controller;
use App\Entity\JobComposite;
use App\Form\Type\JobCompositeType;
use App\Repository\JobCompositeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class JobCompositeController extends AbstractController
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function createJobComposite(Request $request, EntityManagerInterface $entityManager){
        $jobCron = new JobComposite();
        $form = $this->createForm(JobCompositeType::class, $jobCron);
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
    public function readJobComposite( JobCompositeRepository $repository,int $id){
        $job = $repository->findOneBySomeField($id);

        return $this->render('tous.html.twig',['job'=>$job]);
    }
    public function updateJobComposite(Request $request,int $id, JobCompositeRepository $repository)
    {
        $job = $repository->findOneBySomeField($id);
        $form = $this->createForm(JobCompositeType::class, $job);
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
    public function delete( int $id, JobCompositeRepository $repository){
        $property = $repository->findOneBySomeField($id);
        $em =$this->manager;
        $em->remove($property);
        $em->flush();
        return  $this-> redirectToRoute('Home');
    }


}
