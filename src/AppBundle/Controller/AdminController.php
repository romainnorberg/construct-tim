<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Symfony\Component\HttpFoundation\Request,
    AppBundle\Form\Type\AdminFileUploadType,
    Cocur\Slugify\Slugify,
    Aws\S3\S3Client;

class AdminController extends AppBundleBaseController
{
  /**
   * @Route("/admin/upload", name="admin_upload")
   * @Method({"POST"})
   */
  public function uploadAction(Request $request){

    $this->adminFileForm = $this->createForm(AdminFileUploadType::class);

    $this->adminFileForm->handleRequest($request);

    if ($this->adminFileForm->isSubmitted() && $this->adminFileForm->isValid()) {

      $fileExtension = $this->adminFileForm['attachement']->getData()->getClientOriginalExtension();
      $slugify = new Slugify();
      $fileName = $slugify->slugify($this->adminFileForm['attachement']->getData()->getClientOriginalName().time()).'.'.$fileExtension;

      $uploadDir=dirname($this->container->getParameter('kernel.root_dir')) . '/web/uploads/medias';
      $this->adminFileForm['attachement']->getData()->move($uploadDir, $fileName);

      $file_path = $uploadDir.'/'.$fileName;

      // compress
      

      /*
      $imagine = new \Imagine\Gd\Imagine();
      $image = $imagine->open($file_path);
      $thumbnail = $image->thumbnail(new \Imagine\Image\Box(800, 800));
      $thumbnail->save($file_path);
      */

      // upload to amazon
      $s3 = \Aws\S3\S3Client::factory(array(
        'credentials' => array(
          'key'    => $this->getParameter('s3_credentials_key'),
          'secret' => $this->getParameter('S3_CREDENTIALS_SECRET')
        ),
        'region' => $this->getParameter('s3_region'),
        'version' => $this->getParameter('s3_version')
      ));

      //die($file_path);

      $upload = $s3->upload($this->getParameter('s3_bucket'), 'test/'.$fileName, fopen($file_path, 'rb'), 'public-read');

      echo $upload->get('ObjectURL');

      // delete original file


    }

    return $this->render(
      'AppBundle::admin/tinymce/adminFileForm.html.twig',
      [
        'adminFileForm' => $this->adminFileForm->createView()
      ]
    );
  }
}
