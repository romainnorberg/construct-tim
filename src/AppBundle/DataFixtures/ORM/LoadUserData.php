<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $userAdmin = new User();
    $userAdmin->setUsername('admin');
    $userAdmin->setUsernameCanonical('admin');
    $userAdmin->setEmail('admin@example.com');
    $userAdmin->setEmailCanonical('admin@example.com');
    $userAdmin->setEnabled(true);
    $userAdmin->setSalt('1jg8k5bq5dhcsc0owwsk8800ck4ocsw');
    $userAdmin->setPassword('FNjc4+IsTh6/HwWmj77ekVhG5bbi5oHbsDck//Po7EjLca/Jcvksb+3fCABpd55+ycXYdFVLtAJLJI30KH1Y4g==');
    $userAdmin->setRoles(array());

    $manager->persist($userAdmin);

    $manager->flush();
  }
}
