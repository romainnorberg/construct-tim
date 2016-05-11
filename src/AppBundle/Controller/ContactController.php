<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Symfony\Component\HttpFoundation\Request,
    AppBundle\Form\ContactType;

class ContactController extends AppBundleBaseController
{
  var $contact_form;

  /**
   * @Route("/contact", name="contact")
   * @Method({"GET","POST"})
   */
  public function contactAction(Request $request){

    $this->contact_form = $this->createForm(ContactType::class);

    $this->contact_form->handleRequest($request);

    if ($this->contact_form->isSubmitted() && $this->contact_form->isValid()) {

      $data = $this->contact_form->getData();

      $this->sendMail($data);

      return $this->redirectToRoute('contact_thanks', array(), 301);
    }

    return $this->render(
      'AppBundle::contact.html.twig',
      [
        'contactForm' => $this->contact_form->createView()
      ]
    );
  }

  /**
   * @Route("/contact_thanks", name="contact_thanks")
   * @Method({"GET"})
   */
  public function contactThanksAction(Request $request){

    return $this->render(
      'AppBundle::contact_thanks.html.twig'
    );
  }

  private function sendMail($data){


    $mail = \Swift_Message::newInstance()
      ->setSubject('Demande provenant du site Construct-Tim.be')
      ->setFrom('bot@construct-tim.be')
      ->setTo('romainnorberg@gmail.com')
      ->setBody(
          $this->renderView(
              'AppBundle::partials/contact/_mail.html.twig',
              array('data' => $data)
          ),
          'text/html'
      )
    ;

    if($this->contact_form['attachement']->getData()){

        $attachement = $this->contact_form['attachement']->getData();

        $fileName = md5(uniqid()).'.'.$attachement->getClientOriginalExtension();

        $attachement_dir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/contact';
        $attachement->move($attachement_dir, $fileName);

        $mail->attach(\Swift_Attachment::fromPath($attachement_dir.'/'.$fileName));
    }


    $this->get('mailer')->send($mail);
  }
}
