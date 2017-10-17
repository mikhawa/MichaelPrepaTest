<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Blabla")
     * @ORM\JoinTable(name="image_has_blabla",
     *   joinColumns={
     *     @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="blabla_id", referencedColumnName="id")
     *   }
     * )
     */
    private $blabla;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blabla = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Add blabla
     *
     * @param \AppBundle\Entity\Blabla $blabla
     *
     * @return Image
     */
    public function addBlabla(\AppBundle\Entity\Blabla $blabla)
    {
        $this->blabla[] = $blabla;
    
        return $this;
    }

    /**
     * Remove blabla
     *
     * @param \AppBundle\Entity\Blabla $blabla
     */
    public function removeBlabla(\AppBundle\Entity\Blabla $blabla)
    {
        $this->blabla->removeElement($blabla);
    }

    /**
     * Get blabla
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlabla()
    {
        return $this->blabla;
    }
}
