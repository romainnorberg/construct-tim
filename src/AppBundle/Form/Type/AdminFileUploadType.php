<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
  Symfony\Component\Form\FormBuilderInterface,
  Symfony\Component\OptionsResolver\OptionsResolver,
  Symfony\Component\Form\Extension\Core\Type\FileType;

class AdminFileUploadType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('attachement', FileType::class, [
        'label'    => 'Joindre un fichier',
        'required' => false,
      ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {

  }
}
