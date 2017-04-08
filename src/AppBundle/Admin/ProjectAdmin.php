<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin,
  Sonata\AdminBundle\Datagrid\ListMapper,
  Sonata\AdminBundle\Datagrid\DatagridMapper,
  Sonata\AdminBundle\Form\FormMapper;

class ProjectAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper->add('title', 'text');
    $formMapper->add('slug', 'text');
    $formMapper->add('description', 'text', [
      'required' => false,
    ]);
    $formMapper->add('keywords', 'text', [
      'required' => false,
    ]);
    $formMapper->add('content', 'textarea', [
      'attr' => [
        'class'      => 'tinymce',
        'data-theme' => 'admin',
      ],
      'required' => false,
    ]);
    $formMapper->add('project_type');
  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper->add('title');
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper->addIdentifier('title');
  }
}
