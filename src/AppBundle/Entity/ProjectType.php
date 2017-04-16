<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM,
  Gedmo\Mapping\Annotation as Gedmo,
  Symfony\Component\HttpFoundation\File\File,
  Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * ProjectType
 *
 * @ORM\Table(name="project_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectTypeRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class ProjectType
{
  use TimestampableTrait;

  /**
   * @var string
   *
   * @ORM\Column(type="guid")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="UUID")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="title", type="string", length=255)
   */
  private $title;

  /**
   * @var string
   *
   * @ORM\Column(name="page_title", type="string", length=255)
   */
  private $page_title;

  /**
   * @var string
   *
   * @ORM\Column(length=128, unique=true)
   */
  private $slug;

  /**
   * @var string
   *
   * @ORM\Column(name="description", type="string", length=255, nullable=true)
   */
  private $description;

  /**
   * @var string
   *
   * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
   */
  private $keywords;

  /**
   * @var string
   *
   * @ORM\Column(name="content", type="text", nullable=true)
   */
  private $content;

  /**
   * NOTE: This is not a mapped field of entity metadata, just a simple property.
   *
   * @Vich\UploadableField(mapping="ct_image", fileNameProperty="imageName")
   *
   * @var File
   */
  private $image_file;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   *
   * @var string
   */
  private $image_name;

  /**
   * @var ArrayCollection
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Project", mappedBy="project_type")
   */
  private $projects;

  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set title
   *
   * @param string $title
   *
   * @return ProjectType
   */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get title
   *
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }

  public function __toString()
  {
    if (is_null($this->title)) {
      return 'NULL';
    }

    return $this->title;
  }

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Set pageTitle
   *
   * @param string $pageTitle
   *
   * @return ProjectType
   */
  public function setPageTitle($pageTitle)
  {
    $this->page_title = $pageTitle;

    return $this;
  }

  /**
   * Get pageTitle
   *
   * @return string
   */
  public function getPageTitle()
  {
    return $this->page_title;
  }

  /**
   * Set slug
   *
   * @param string $slug
   *
   * @return ProjectType
   */
  public function setSlug($slug)
  {
    $this->slug = $slug;

    return $this;
  }

  /**
   * Get slug
   *
   * @return string
   */
  public function getSlug()
  {
    return $this->slug;
  }

  /**
   * Set description
   *
   * @param string $description
   *
   * @return ProjectType
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get description
   *
   * @return string
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set keywords
   *
   * @param string $keywords
   *
   * @return ProjectType
   */
  public function setKeywords($keywords)
  {
    $this->keywords = $keywords;

    return $this;
  }

  /**
   * Get keywords
   *
   * @return string
   */
  public function getKeywords()
  {
    return $this->keywords;
  }

  /**
   * Set content
   *
   * @param string $content
   *
   * @return ProjectType
   */
  public function setContent($content)
  {
    $this->content = $content;

    return $this;
  }

  /**
   * Get content
   *
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * Set imageName
   *
   * @param string $imageName
   *
   * @return ProjectType
   */
  public function setImageName($imageName)
  {
    $this->image_name = $imageName;

    return $this;
  }

  /**
   * Get imageName
   *
   * @return string
   */
  public function getImageName()
  {
    return $this->image_name;
  }

  /**
   * Add project
   *
   * @param \AppBundle\Entity\Project $project
   *
   * @return ProjectType
   */
  public function addProject(\AppBundle\Entity\Project $project)
  {
    $this->projects[] = $project;

    return $this;
  }

  /**
   * Remove project
   *
   * @param \AppBundle\Entity\Project $project
   */
  public function removeProject(\AppBundle\Entity\Project $project)
  {
    $this->projects->removeElement($project);
  }

  /**
   * Get projects
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getProjects()
  {
    return $this->projects;
  }
}
