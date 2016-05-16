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

    $filesystem = $this->get('knp_gaufrette.filesystem_map')->get('filesystem_aws_s3_images');
        $file = $filesystem->get($projectType->getImageName());

        /*
         * Note the use of the dump() function.
         * If you don't have the VarDumperComponent installed, use var_dump().
         * @see http://symfony.com/doc/current/components/var_dumper/introduction.html
         */
        //dump($file);die;

    //$helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
    //$imagepath = $helper->asset($projectType, 'imageFile');
    //

    $image = $projectType->getImageName();

    return $this->render(
      'AppBundle::test.html.twig',
      [
        'image' => $image
      ]
    );
  }
}
