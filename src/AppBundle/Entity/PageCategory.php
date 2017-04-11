<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM,
  Gedmo\Mapping\Annotation as Gedmo;

/**
 * PageCategory
 *
 * @ORM\Table(name="page_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageCategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PageCategory
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
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(name="description", type="text", nullable=true)
   */
  private $description;


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
   * @return PageCategory
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

  public function __toString()
  {
    if (is_null($this->name)) {
      return 'NULL';
    }

    return $this->name;
  }


  /**
   * Set description
   *
   * @param string $description
   *
   * @return PageCategory
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
}
