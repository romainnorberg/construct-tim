<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request;

class ErrorController extends Controller
{

  /**
   * @Route("/error", name="error")
   * @Method({"GET"})
   */
  public function errorAction(Request $request)
  {
    throw new \Exception('Something went wrong!');
  }
}
