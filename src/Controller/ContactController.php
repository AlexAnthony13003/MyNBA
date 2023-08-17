<?php
// src/Controller/ContactController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $message = $request->request->get('message');

            $email = (new Email())
                ->from($email)
                ->to('alexis.guillermain.s@gmail.com')
                ->subject('Nouveau message de contact')
                ->html($this->renderView(
                    'contact/email.html.twig',
                    ['name' => $name, 'email' => $email, 'message' => $message]
                ));

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé avec succès !');
        }

        return $this->render('contact/index.html.twig');
    }
}
