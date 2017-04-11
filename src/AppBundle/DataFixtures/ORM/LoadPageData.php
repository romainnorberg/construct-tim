<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Page;

class LoadPageData implements FixtureInterface, ContainerAwareInterface
{

  /**
   * @var ContainerInterface
   */
  private $container;

  /**
   * {@inheritDoc}
   */
  public function setContainer(ContainerInterface $container = null)
  {
    $this->container = $container;
  }

  public function load(ObjectManager $manager)
  {

    $skill = new Page();
    $skill->setName('Test page');
    $skill->setTitle('Test àalo 8çé Pke-Koj');
    $skill->setActive(false);

    // On la persiste
    $manager->persist($skill);

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}
