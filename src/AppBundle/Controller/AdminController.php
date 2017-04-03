<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\AdminFileUploadType;
use Cocur\Slugify\Slugify;

class AdminController extends AppBundleBaseController
{
  /**
   * @Route("/admin/upload", name="admin_upload")
   * @Method({"POST"})
   */
  public function uploadAction(Request $request)
  {
    $admin_file_form = $this->createForm(AdminFileUploadType::class);

    $admin_file_form->handleRequest($request);

    if ($admin_file_form->isSubmitted() && $admin_file_form->isValid()) {

      $fileExtension = $admin_file_form['attachement']->getData()->getClientOriginalExtension();
      $slugify = new Slugify();
      $fileName = $slugify->slugify($admin_file_form['attachement']->getData()->getClientOriginalName() . time()) . '.' . $fileExtension;

      $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/uploads/medias';
      $admin_file_form['attachement']->getData()->move($uploadDir, $fileName);

      $file_path = $uploadDir . '/' . $fileName;

      // compress
      $imagine = new \Imagine\Gd\Imagine();
      $image = $imagine->open($file_path);
      $thumbnail = $image->thumbnail(new \Imagine\Image\Box(800, 800));
      $thumbnail->save($file_path);

      // upload to bucket

      return $this->redirectToRoute('admin_upload');

    }

    return $this->render(
      'AppBundle::admin/tinymce/adminFileForm.html.twig',
      [
        'adminFileForm' => $admin_file_form->createView(),
      ]
    );
  }
}
