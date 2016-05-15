<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectTypeAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', 'text');
        $formMapper->add('page_title', 'text');
        $formMapper->add('slug', 'text');
        $formMapper->add('description', 'text');
        $formMapper->add('content', 'textarea');
        $formMapper->add('imageFile', VichImageType::class, array(
          'required'      => false,
          'allow_delete'  => true,
          'download_link' => true,
        ));
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
