<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM,
  Gedmo\Mapping\Annotation as Gedmo;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Page
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
   * @var PageCategory
   *
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PageCategory")
   * @ORM\JoinColumn(name="page_category_id", referencedColumnName="id")
   */
  private $page_category;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

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
   * @var text
   *
   * @ORM\Column(name="content", type="text", nullable=true)
   */
  private $content;

  /**
   * @var text
   *
   * @ORM\Column(name="description", type="text", nullable=true)
   */
  private $description;

  /**
   * @var string
   *
   * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
   */
  private $keywords;

  /**
   * @var boolean
   *
   * @ORM\Column(name="active", type="boolean")
   */
  private $active;

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
   * Set name
   *
   * @param string $name
   *
   * @return Page
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set title
   *
   * @param string $title
   *
   * @return Page
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
   * @return Page
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
   * Set content
   *
   * @param string $content
   *
   * @return Page
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
   * Set description
   *
   * @param string $description
   *
   * @return Page
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
   * @return Page
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
   * @return Page
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
   * Set page_category
   *
   * @param \AppBundle\Entity\PageCategory $pageCategory
   *
   * @return Page
   */
  public function setPageCategory(\AppBundle\Entity\PageCategory $pageCategory = null)
  {
    $this->page_category = $pageCategory;

    return $this;
  }

  /**
   * Get page_category
   *
   * @return \AppBundle\Entity\PageCategory
   */
  public function getPageCategory()
  {
    return $this->page_category;
  }
}
