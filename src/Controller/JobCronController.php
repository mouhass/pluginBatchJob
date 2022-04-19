<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Job;
use App\Entity\JobComposite;
use App\Entity\JobCron;
use App\Form\AdminType;
use App\Form\JobCronType;
use App\Form\JobType;
use App\Message\LogCommand;
use App\Repository\AdminRepository;
use App\Repository\HistoriqueRepository;
use App\Repository\JobCronRepository;
use Cron\CronExpression;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Panlatent\CronExpressionDescriptor\ExpressionDescriptor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/admin/job/cron")
 */
class JobCronController extends AbstractController
{
    private $jobCronRepo;
    private $manager;
    public function __construct(JobCronRepository $jobCronRepo,EntityManagerInterface $manager)
    {
        $this->jobCronRepo = $jobCronRepo;
        $this->manager = $manager;
    }


    /**
     * @Route("/", name="app_jobCron_index", methods={"GET"})
     */
    public function index(JobCronRepository $jobCronRepository): Response
    {
        return $this->render('JobCron/index.html.twig', [
            'jobCron' => $jobCronRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_jobCron_new", methods={"GET", "POST"})
     */
    public function new(Request $request, JobCronRepository $jobCronRepository): Response
    {
        $jobCron = new JobCron();
        $form = $this->createForm(JobCronType::class, $jobCron);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobCronRepository->add($jobCron);

            return $this->redirectToRoute('app_jobCron_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('JobCron/new.html.twig', [
            'admin' => $jobCron,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_JobCron_show", methods={"GET"})
     */
    public function show(JobCron $jobCron): Response
    {
       // $jobCron = $this->jobCronRepo->findElementById('secondJobCron');
        return $this->render('JobCron/show.html.twig', [
            'JobCron' => $jobCron,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_JobCron_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobCron $jobCron, JobCronRepository $repository): Response
    {

        $form = $this->createForm(JobCronType::class, $jobCron);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em=$this->manager;
            $em->persist($jobCron);
            $em->flush();
            $this->addFlash('success',"un job cron a ete modifié avec succes");


            return $this->redirectToRoute('app_jobCron_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('JobCron/edit.html.twig', [
            'JobCron' => $jobCron,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="app_JobCron_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, JobCron $jobCron, JobCronRepository $jobCronRepository): Response
    {
         if($jobCron->getJobComposites()->toArray()==[]) {
             $jobCronRepository->remove($jobCron);
         }
         else{
             $this->addFlash('error', "This user has connected services, so it can't be removed.");
         }

        return $this->redirectToRoute('app_jobCron_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/execImme", name="app_JobCron_execute" , methods={"GET","POST"})
     */
    public function execImm(KernelInterface $kernel,JobCron $jobCron){

        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput(array(
            'command' => $jobCron->getScriptExec(),
            'Related_job'=>$jobCron->getId()
        ));

        // Use the NullOutput class instead of BufferedOutput.
        $output = new BufferedOutput();

        $application->run($input, $output);

        $content = $output->fetch();
        return $this->redirectToRoute('app_jobCron_index', [], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/jareb/jareb" ,name="jareb_jareb" , methods={"GET"})
     */
    public function getComposite(JobCronRepository $repository)
    {
        $jobCron = $repository->findElementById(8);
        dd($jobCron);

    }

    /**
     * @Route("/{id}/downloadFile", name="app_JobCron_downloadFiles" ,methods={"GET"})
     */
    public function download(JobCron $jobCron,HistoriqueRepository $repository,KernelInterface $kernel){

        $historique = $repository->findByExampleField($jobCron);

        return $this->file($kernel->getProjectDir().max($historique)->getPath());
    }


    /**
     * @Route("/{id}/actifdesactif", name="app_JobCron_actifdesactif",methods={"GET","PUT"})
     */
    public function actifdesactif(JobCron $jobCron,EntityManagerInterface $manager){
        if($jobCron->getActif()){
            $jobCron->setActif(false);
            $manager->persist($jobCron);
            $manager->flush();
        }
        else{
            $jobCron->setActif(true);
            $manager->persist($jobCron);
            $manager->flush();
        }
        return $this->redirectToRoute('app_jobCron_index', [], Response::HTTP_SEE_OTHER);
    }




    /**
     * @Route("/{id}/date/",name="app_JobCron_date" , methods={"GET"})
     */
    public function giveDate(JobCronRepository $repository){
        return new Response($repository->giveDateTime());
    }

    /**
     * @Route("/{id}/nextDate/",name="app_JobCron_nextdate",methods={"GET"})
     */
    public function nextDate(JobCronRepository $repository){
        $cron = new CronExpression('* * * * *');
        return new Response($cron->getNextRunDate()->format('i G j n w'));
    }


}
