<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{

    public function sendEmail(MailerInterface $mailer,String $sthing): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('hassine.mounir1234@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text($sthing)
            ->html('<p>erreur</p>');

        $mailer->send($email);
        return new Response("email was sent");

    }
}
