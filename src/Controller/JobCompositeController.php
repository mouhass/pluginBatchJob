<?php

namespace App\Controller;

use App\Entity\JobComposite;
use App\Entity\JobCron;
use App\Form\JobCompositeType;
use App\Repository\JobCompositeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/job/composite")
 */
class JobCompositeController extends AbstractController
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="app_job_composite_index", methods={"GET"})
     */
    public function index(JobCompositeRepository $jobCompositeRepository): Response
    {
        return $this->render('job_composite/index.html.twig', [
            'job_composites' => $jobCompositeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_job_composite_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jobComposite = new JobComposite();
        $form = $this->createForm(JobCompositeType::class, $jobComposite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobComposite);
            $entityManager->flush();

            return $this->redirectToRoute('app_job_composite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_composite/new.html.twig', [
            'job_composite' => $jobComposite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_job_composite_show", methods={"GET"})
     */
    public function show(JobComposite $jobComposite): Response
    {
        return $this->render('job_composite/show.html.twig', [
            'job_composite' => $jobComposite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_job_composite_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, JobComposite $jobComposite,EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(JobCompositeType::class, $jobComposite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em=$manager;
            $em->persist($jobComposite);
            $em->flush();
            $this->addFlash('success',"un job composite a ete modifié avec succes");
            return $this->redirectToRoute('app_job_composite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_composite/edit.html.twig', [
            'job_composite' => $jobComposite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_job_composite_delete", methods={"POST"})
     */
    public function delete(Request $request, JobComposite $jobComposite, EntityManagerInterface $entityManager): Response
    {
//        if ($this->isCsrfTokenValid('delete'.$jobComposite->getId(), $request->request->get('_token'))) {
//            $entityManager->remove($jobComposite);
//            $entityManager->flush();
//        }

        return $this->redirectToRoute('app_job_composite_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/execImme", name="app_JobComposite_execute" , methods={"GET","POST"})
     */

    public function execImm(KernelInterface $kernel,JobComposite $jobComposite){

        $application = new Application($kernel);
        $application->setAutoExit(false);
        $myList = $jobComposite->getListSousJobs();
        $content = "";
        for($x=0;$x<=count($myList)-1;$x++){
            if($myList[$x]->actif) {
                $input = new ArrayInput(array(
                    'command' => $myList[$x]->getScriptExec(),
                    'Related_job'=>$jobComposite->getId()
                ));

                // Use the NullOutput class instead of BufferedOutput.
                $output = new BufferedOutput();

                $application->run($input, $output);

                $content = $content . $output->fetch();
            }
        }


        return new Response($content);
    }

    /**
     * @Route("/test/test", name="test_test", methods={"GET"})
     */
    public function verifiverif(JobCompositeRepository $repository ,EntityManagerInterface $entityManager)
    {
        $res = $repository->verifyJobCron("app:sayhello",$entityManager);
       dd($res);

    }

    /**
     * @Route("/{id}/downloadFiles", name="app_JobComposite_downloadFiles")
     */
    public function download(){

    }



}
