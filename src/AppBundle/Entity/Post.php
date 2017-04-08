<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Entity\Traits\TimestampableTrait;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Post
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
   * @var string
   *
   * @ORM\Column(name="labels", type="string", length=255, nullable=true)
   */
  private $labels;

  /**
   * @var bool
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
   * Set title
   *
   * @param string $title
   *
   * @return Post
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
   * @return Post
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
   * @return Post
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
   * @return Post
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
   * @return Post
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
   * Set labels
   *
   * @param string $labels
   *
   * @return Post
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
   * Set active
   *
   * @param boolean $active
   *
   * @return Post
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
}
