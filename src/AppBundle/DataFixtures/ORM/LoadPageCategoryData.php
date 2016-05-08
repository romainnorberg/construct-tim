<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\PageCategory;

class LoadPageCategoryData implements FixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
      $this->container = $container;
    }

    public function load(ObjectManager $manager) {

      $page_category = new PageCategory();
      $page_category->setName('Test page category 1');

      $manager->persist($page_category);

      $page_category = new PageCategory();
      $page_category->setName('Test page category 2');

      $manager->persist($page_category);

      $manager->flush();
    }
  }
