<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin,
  Sonata\AdminBundle\Datagrid\ListMapper,
  Sonata\AdminBundle\Datagrid\DatagridMapper,
  Sonata\AdminBundle\Form\FormMapper;

class PageCategoryAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper->add('name', 'text');
    $formMapper->add('description', 'text', [
      'required' => false,
    ]);
  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper->add('name');
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper->addIdentifier('name');
  }
}
