<?php

namespace FSi\FixturesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\GalleryBundle\Model\Photo as BasePhoto;

/**
 * @ORM\Entity
 * @ORM\Table(name="fsi_gallery_photo")
 */
class Photo extends BasePhoto
{
}