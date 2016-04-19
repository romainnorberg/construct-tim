<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Form\Extension\Core\Type\SubmitType,
    Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
  /**
   * @Route("/", name="homepage")
   */
  public function indexAction(Request $request)
  {
    return $this->render(
      'AppBundle::index.html.twig'
    );
  }

  /**
   * @Route("/contact", name="contact")
   */
  public function contactAction(Request $request){
    $form = $this->createFormBuilder()
      ->add('name', TextType::class)
      ->add('submit', SubmitType::class, [
          'label' => 'Submit Me Now!',
          'attr'  => [
              'class' => 'btn btn-success'
          ]
      ])
      ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $name = $form->getData()['name'];
      $this->sendMail($name);
    }

    return $this->render(
      'AppBundle::contact.html.twig',
      [
        'contactForm' => $form->createView()
      ]
    );
  }

  private function sendMail($body){
      $mail = \Swift_Message::newInstance()
        ->setSubject('test mail')
        ->setFrom('bot@construct-tim.be')
        ->setTo('romainnorberg@gmail.com')
        ->setBody('message body goes here ' . $body)
      ;

      $this->get('mailer')->send($mail);
  }
}
