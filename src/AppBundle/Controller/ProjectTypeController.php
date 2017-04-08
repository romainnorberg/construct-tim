<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * project controller.
 *
 * @Route("/projets")
 */
class ProjectTypeController extends Controller
{
  /**
   * @Route("/{slug}", name="project_type_show")
   * @Method({"GET"})
   * @ParamConverter("ProjectType", class="AppBundle:ProjectType")
   * @param ProjectType $project_type
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function showAction(ProjectType $project_type)
  {
    $projects = $project_type->getProjects();

    return $this->render(
      'AppBundle:project:project_type_show.html.twig',
      [
        'project_type' => $project_type,
        'projects'     => $projects,
      ]
    );
  }
}
