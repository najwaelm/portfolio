<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;



class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,
    EntityManagerInterface $manager,
    MailerInterface $mailer
    ): Response
    {

        $contact = new Contact();
      
        
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            
            $manager->persist($contact);

            $manager->flush();
            #EMAIL

            //SEND EMAIL
  
            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('najwaelmernissi@gmail.com')
                ->replyTo('reply-to@example.com')
                ->subject($contact->getEmail())
                ->htmlTemplate('emails/contact.html.twig')

   
                // pass variables (name => value) to the template
                ->context([
                    'contact' => $contact,
                ]);

            $mailer->send($email);


            $this->addFlash(
                'success',
                'Your message has been sent!'
            );

            // return $this->redirectToRoute('/');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}
