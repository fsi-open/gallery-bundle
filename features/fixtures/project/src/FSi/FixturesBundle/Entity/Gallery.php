<?php

namespace FSi\FixturesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\GalleryBundle\Model\Gallery as BaseGallery;

/**
 * @ORM\Entity
 * @ORM\Table(name="fsi_gallery")
 */
class Gallery extends BaseGallery
{
    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="gallery")
     */
    protected $photos;
}