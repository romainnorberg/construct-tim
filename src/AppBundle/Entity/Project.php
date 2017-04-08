<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM,
  Gedmo\Mapping\Annotation as Gedmo;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Project
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
   * @var ProjectType
   *
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProjectType", inversedBy="projects")
   * @ORM\JoinColumn(name="project_type_id", referencedColumnName="id")
   */
  private $project_type;

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
   * @var string
   *
   * @ORM\Column(name="content", type="text", nullable=true)
   */
  private $content;

  /**
   * @var \DateTime $start_date
   *
   * @ORM\Column(type="datetime")
   */
  private $start_date;

  /**
   * @var \DateTime $end_date
   *
   * @ORM\Column(type="datetime")
   */
  private $end_date;

  /**
   * @var bool
   *
   * @ORM\Column(name="active", type="boolean")
   */
  private $active;

  /**
   * @var string
   *
   * @ORM\Column(name="labels", type="string", length=255, nullable=true)
   */
  private $labels;

  /**
   * @var string
   *
   * @ORM\Column(name="place", type="string", length=255, nullable=true)
   */
  private $place;

  /**
   * @var string
   *
   * @ORM\Column(name="client", type="string", length=255, nullable=true)
   */
  private $client;


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
   * Set projectTypeId
   *
   * @param integer $projectTypeId
   *
   * @return Project
   */
  public function setProjectTypeId($projectTypeId)
  {
    $this->projectTypeId = $projectTypeId;

    return $this;
  }

  /**
   * Get projectTypeId
   *
   * @return integer
   */
  public function getProjectTypeId()
  {
    return $this->projectTypeId;
  }

  /**
   * Set title
   *
   * @param string $title
   *
   * @return Project
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
    return $this->title;
  }

  /**
   * Set slug
   *
   * @param string $slug
   *
   * @return Project
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
   * @return Project
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
   * @return Project
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
   * @return Project
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
   * Set start_date
   *
   * @param \DateTime $startDate
   *
   * @return Project
   */
  public function setStartDate($startDate)
  {
    $this->start_date = $startDate;

    return $this;
  }

  /**
   * Get start_date
   *
   * @return \DateTime
   */
  public function getStartDate()
  {
    return $this->start_date;
  }

  /**
   * Set end_date
   *
   * @param \DateTime $endDate
   *
   * @return Project
   */
  public function setEndDate($endDate)
  {
    $this->end_date = $endDate;

    return $this;
  }

  /**
   * Get end_date
   *
   * @return \DateTime
   */
  public function getEndDate()
  {
    return $this->end_date;
  }

  /**
   * Set active
   *
   * @param boolean $active
   *
   * @return Project
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
   * Set labels
   *
   * @param string $labels
   *
   * @return Project
   */
  public function setLabels($labels)
  {
    $this->labels = $labels;

    return $this;
  }

  /**
   * Get labels
   *
   * @return string
   */
  public function getLabels()
  {
    return $this->labels;
  }

  /**
   * Set place
   *
   * @param string $place
   *
   * @return Project
   */
  public function setPlace($place)
  {
    $this->place = $place;

    return $this;
  }

  /**
   * Get place
   *
   * @return string
   */
  public function getPlace()
  {
    return $this->place;
  }

  /**
   * Set client
   *
   * @param string $client
   *
   * @return Project
   */
  public function setClient($client)
  {
    $this->client = $client;

    return $this;
  }

  /**
   * Get client
   *
   * @return string
   */
  public function getClient()
  {
    return $this->client;
  }

  /**
   * Set project_type
   *
   * @param \AppBundle\Entity\ProjectType $projectType
   *
   * @return Project
   */
  public function setProjectType(\AppBundle\Entity\ProjectType $projectType = null)
  {
    $this->project_type = $projectType;

    return $this;
  }

  /**
   * Get project_type
   *
   * @return \AppBundle\Entity\ProjectType
   */
  public function getProjectType()
  {
    return $this->project_type;
  }
}
