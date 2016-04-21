<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
  /**
   * @Route("/", name="homepage")
   * @Method({"GET"})
   */
  public function indexAction(Request $request)
  {
    throw new Exception("Test precommit phpunit", 1);

    return $this->render(
      'AppBundle::index.html.twig'
    );
  }
}
