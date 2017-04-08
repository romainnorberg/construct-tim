<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM,
  Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProjectPhoto
 *
 * @ORM\Table(name="project_photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectPhotoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectPhoto
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
   * @var Project
   *
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project")
   * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
   */
  private $project;

  /**
   * @var string
   *
   * @ORM\Column(name="title", type="string", length=255)
   */
  private $title;

  /**
   * @Gedmo\Slug(fields={"title"})
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
   * @var bool
   *
   * @ORM\Column(name="active", type="boolean")
   */
  private $active;

  /**
   * @var bool
   *
   * @ORM\Column(name="cover", type="boolean")
   */
  private $cover;


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
   * Set projectId
   *
   * @param integer $projectId
   *
   * @return ProjectPhoto
   */
  public function setProjectId($projectId)
  {
    $this->projectId = $projectId;

    return $this;
  }

  /**
   * Get projectId
   *
   * @return integer
   */
  public function getProjectId()
  {
    return $this->projectId;
  }

  /**
   * Set title
   *
   * @param string $title
   *
   * @return ProjectPhoto
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

  /**
   * Set slug
   *
   * @param string $slug
   *
   * @return ProjectPhoto
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
   * @return ProjectPhoto
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
   * @return ProjectPhoto
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
   * Set active
   *
   * @param boolean $active
   *
   * @return ProjectPhoto
   */
  public function setActive($active)
  {
    $this->active = $active;

    return $this;
  }

  /**
   * Get active
   *
   * @return boolean
   */
  public function getActive()
  {
    return $this->active;
  }

  /**
   * Set cover
   *
   * @param boolean $cover
   *
   * @return ProjectPhoto
   */
  public function setCover($cover)
  {
    $this->cover = $cover;

    return $this;
  }

  /**
   * Get cover
   *
   * @return boolean
   */
  public function getCover()
  {
    return $this->cover;
  }

  /**
   * Set project
   *
   * @param \AppBundle\Entity\Project $project
   *
   * @return ProjectPhoto
   */
  public function setProject(\AppBundle\Entity\Project $project = null)
  {
    $this->project = $project;

    return $this;
  }

  /**
   * Get project
   *
   * @return \AppBundle\Entity\Project
   */
  public function getProject()
  {
    return $this->project;
  }
}
