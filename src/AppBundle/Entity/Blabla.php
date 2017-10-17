<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blabla
 *
 * @ORM\Table(name="blabla", indexes={@ORM\Index(name="fk_blabla_fos_user_idx", columns={"fos_user_id"})})
 * @ORM\Entity
 */
class Blabla
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
     * @ORM\Column(name="titre", type="string", length=100, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", length=65535, nullable=true)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ladate", type="datetime", nullable=true)
     */
    private $ladate;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fos_user_id", referencedColumnName="id")
     * })
     */
    private $fosUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Image")
     * @ORM\JoinTable(name="image_has_blabla",
     *   joinColumns={
     *     @ORM\JoinColumn(name="blabla_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     *   }
     * )
     */
    private $image;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Blabla
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Blabla
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
    
        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set ladate
     *
     * @param \DateTime $ladate
     *
     * @return Blabla
     */
    public function setLadate($ladate)
    {
        $this->ladate = $ladate;
    
        return $this;
    }

    /**
     * Get ladate
     *
     * @return \DateTime
     */
    public function getLadate()
    {
        return $this->ladate;
    }

    /**
     * Set fosUser
     *
     * @param \AppBundle\Entity\FosUser $fosUser
     *
     * @return Blabla
     */
    public function setFosUser(\AppBundle\Entity\FosUser $fosUser = null)
    {
        $this->fosUser = $fosUser;
    
        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \AppBundle\Entity\FosUser
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Blabla
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->image[] = $image;
    
        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->image;
    }
}
