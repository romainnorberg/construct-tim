<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Form\Extension\Core\Type\SubmitType,
    Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactController extends AppBundleBaseController
{
  /**
   * @Route("/contact", name="contact")
   * @Method({"GET","POST"})
   */
  public function contactAction(Request $request){
    $form = $this->createFormBuilder()
      ->add('name', TextType::class, [
        'attr'  => [
          'placeholder' => 'Nom et prénom',
          'required' => true
        ]
      ])
      ->add('submit', SubmitType::class, [
        'label' => 'Envoyer la demande',
        'attr'  => [
            'class' => 'btn send'
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
