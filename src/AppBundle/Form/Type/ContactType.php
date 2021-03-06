<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
  Symfony\Component\Form\FormBuilderInterface,
  Symfony\Component\OptionsResolver\OptionsResolver,
  Symfony\Component\Form\Extension\Core\Type\SubmitType,
  Symfony\Component\Form\Extension\Core\Type\TextType,
  Symfony\Component\Form\Extension\Core\Type\TextareaType,
  Symfony\Component\Form\Extension\Core\Type\ChoiceType,
  Symfony\Component\Form\Extension\Core\Type\FileType,
  Symfony\Component\Validator\Constraints\Length,
  Symfony\Component\Validator\Constraints\NotBlank,
  Symfony\Component\Validator\Constraints\Email,
  EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType,
  EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

class ContactType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class, [
        'attr'        => [
          'placeholder' => 'Nom et prénom',
        ],
        'required'    => true,
        'constraints' => [
          new NotBlank(),
          new Length(array('min' => 3)),
        ],
      ])
      ->add('email', TextType::class, [
        'attr'        => [
          'placeholder' => 'Adresse e-mail',
        ],
        'required'    => true,
        'constraints' => [
          new NotBlank(),
          new Email(),
        ],
      ])
      ->add('phone', TextType::class, [
        'attr'     => [
          'placeholder' => 'Téléphone',
        ],
        'required' => false,
      ])
      ->add('city', TextType::class, [
        'attr'     => [
          'placeholder' => 'Ville',
        ],
        'required' => false,
      ])
      ->add('type', ChoiceType::class, [
        'choices' => [
          'Demande de prix' => 'Demande de prix',
          'Autre'           => 'Autre',
        ],
      ])
      ->add('subject', ChoiceType::class, [
        'choices' => [
          'Construction'   => 'Construction',
          'Transformation' => 'Transformation',
          'Rénovation'     => 'Rénovation',
          'Autre'          => 'Autre',
        ],
      ])
      ->add('budget', TextType::class, [
        'attr'     => [
          'placeholder' => 'Budget',
        ],
        'required' => false,
      ])
      ->add('attachement', FileType::class, [
        'label'    => 'Joindre un fichier',
        'required' => false,
      ])
      ->add('recaptcha', EWZRecaptchaType::class, [
        'attr'        => [
          'options' => [
            'theme' => 'light',
            'type'  => 'image',
            'size'  => 'normal',
            'defer' => true,
            'async' => true,
          ],
        ],
        'mapped'      => false,
        'constraints' => [
          new RecaptchaTrue(),
        ],
        'required'    => true,
      ])
      ->add('message', TextareaType::class, [
        'attr'        => [
          'placeholder' => 'Message / demande',
          'required'    => true,
        ],
        'constraints' => [
          new NotBlank(),
        ],
      ])
      ->add('submit', SubmitType::class, [
        'label' => 'Envoyer la demande',
        'attr'  => [
          'class' => 'btn send',
        ],
      ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {

  }
}
