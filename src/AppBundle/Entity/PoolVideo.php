<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PoolVideo
 *
 * @ORM\Table(name="pool_video")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PoolVideoRepository")
 * @UniqueEntity(fields="libelle", message="Une vidéo existe déjà avec ce titre.")
 */
class PoolVideo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $libelle;

     /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Video", mappedBy="poolVideo")
    */
    private $videos; // Notez le « s », une annonce est liée à plusieurs candidatures





    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }





    /**
    * @param Video $video
    */
    public function addVideo(Video $video)
    {
        $this->videos[] = $video;

        // On lie l'annonce à la candidature
        $video->setPoolVideo($this);
    }

    /**
    * @param Video $video
    */
    public function removeVideo(Video $video)
    {
        $this->videos->removeElement($video);
    }

    /**
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getVideos()
    {
        return $this->videos;
    }








    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return PoolVideo
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}

