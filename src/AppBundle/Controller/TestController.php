<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    AppBundle\Entity\ProjectType;

class TestController extends Controller
{
  /**
   * @Route("/test", name="test")
   * @Method({"GET"})
   */
  public function TestAction(Request $request)
  {

    $projectType = $this->getDoctrine()
        ->getRepository('AppBundle:ProjectType')
        ->find('23e64e10-1767-11e6-a73b-080027716959');

    if (!$projectType) {
        throw $this->createNotFoundException(
            'No product found for id '.$productId
        );
    }

    $image = $projectType->getImageName();

    return $this->render(
      'AppBundle::test.html.twig',
      [
        'image' => $image
      ]
    );
  }
}
