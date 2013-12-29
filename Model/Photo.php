<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Model;

class Photo implements PhotoInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var mixed
     */
    protected $photo;

    /**
     * @var string
     */
    protected $photoFileKey;

    /**
     * @var GalleryInterface
     */
    protected $gallery;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photoFileKey
     */
    public function setPhotoFileKey($photoFileKey)
    {
        $this->photoFileKey = $photoFileKey;
    }

    /**
     * @return mixed
     */
    public function getPhotoFileKey()
    {
        return $this->photoFileKey;
    }

    /**
     * @param \FSi\Bundle\GalleryBundle\Model\GalleryInterface $gallery
     */
    public function setGallery(GalleryInterface $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return \FSi\Bundle\GalleryBundle\Model\GalleryInterface
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}