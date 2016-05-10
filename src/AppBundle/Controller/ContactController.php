<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Form\Extension\Core\Type\SubmitType,
    Symfony\Component\Form\Extension\Core\Type\TextType,
    Symfony\Component\Form\Extension\Core\Type\TextareaType,
    Symfony\Component\Form\Extension\Core\Type\ChoiceType,
    Symfony\Component\Form\Extension\Core\Type\FileType,
    Symfony\Component\Validator\Constraints\Length,
    Symfony\Component\Validator\Constraints\NotBlank,
    Symfony\Component\Validator\Constraints\Email,
    EWZ\Bundle\RecaptchaBundle\Form\Type\RecaptchaType,
    EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

class ContactController extends AppBundleBaseController
{
  var $contact_form;

  /**
   * @Route("/contact", name="contact")
   * @Method({"GET","POST"})
   */
  public function contactAction(Request $request){

    $this->createContactForm();

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

  public function createContactForm(){
    $this->contact_form = $this->createFormBuilder(array('allow_extra_fields' => true))
      ->add('name', TextType::class, [
        'attr'  => [
          'placeholder' => 'Nom et prénom',
          'required' => true
        ],
        'constraints' => [
           new NotBlank(),
           new Length(array('min' => 3)),
        ]
      ])
      ->add('email', TextType::class, [
        'attr'  => [
          'placeholder' => 'Adresse e-mail',
          'required' => true
        ],
        'constraints' => [
           new NotBlank(),
           new Email(),
        ]
      ])
      ->add('phone', TextType::class, [
        'attr'  => [
          'placeholder' => 'Téléphone'
        ]
      ])
      ->add('city', TextType::class, [
        'attr'  => [
          'placeholder' => 'Ville'
        ]
      ])
      ->add('type', ChoiceType::class, [
        'choices'  => [
            'Demande de prix' => 'Demande de prix',
            'Autre' => 'Autre'
        ],
        'choices_as_values' => true,
      ])
      ->add('subject', ChoiceType::class, [
        'choices'  => [
            'Construction' => 'Construction',
            'Transformation' => 'Transformation',
            'Rénovation' => 'Rénovation',
            'Autre' => 'Autre'
        ],
        'choices_as_values' => true,
      ])
      ->add('budget', TextType::class, [
        'attr'  => [
          'placeholder' => 'Budget'
        ]
      ])
      ->add('attachement', FileType::class, array('label' => 'Joindre un fichier'))
      ->add('recaptcha', RecaptchaType::class, [
        'attr' => [
            'options' => [
                'theme' => 'light',
                'type'  => 'image',
                'size'  => 'normal',
                'defer' => true,
                'async' => true
            ]
        ],
        'mapped'      => false,
        'constraints' => [
            new RecaptchaTrue()
        ]
      ])
      ->add('message', TextareaType::class, [
        'attr'  => [
          'placeholder' => 'Message / demande',
          'required' => true
        ],
        'constraints' => [
           new NotBlank()
        ]
      ])
      ->add('submit', SubmitType::class, [
        'label' => 'Envoyer la demande',
        'attr'  => [
            'class' => 'btn send'
        ]
      ])
      ->getForm();
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

        $mail->attach(\Swift_Attachment::fromPath($attachement_dir.$attachement->getClientOriginalName()));
    }


    $this->get('mailer')->send($mail);
  }
}
