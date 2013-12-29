<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Gallery implements GalleryInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Boolean
     */
    protected $visible;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var PhotoInterface[]
     */
    protected $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param PhotoInterface $photo
     */
    public function addPhoto(PhotoInterface $photo)
    {
        if (!$this->photos->contains($photo)) {
            $photo->setGallery($this);
            $this->photos->add($photo);
        }
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $photos
     */
    public function setPhotos(Collection $photos)
    {
        foreach ($photos as $photo) {
            /* @var PhotoInterface $photo */
            $this->addPhoto($photo);
        }
    }

    /**
     * @return \FSi\Bundle\GalleryBundle\Model\PhotoInterface[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @return Boolean
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * @param Boolean $visible
     */
    public function setVisible($visible = true)
    {
        $this->visible = $visible;
    }
}