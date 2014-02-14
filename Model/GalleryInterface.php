<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Model;

use Doctrine\Common\Collections\Collection;

interface GalleryInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string|null
     */
    public function getDescription();

    /**
     * @return boolean
     */
    public function isVisible();

    /**
     * @param PhotoInterface $photo
     */
    public function addPhoto(PhotoInterface $photo);

    /**
     * @param PhotoInterface $photo
     */
    public function removePhoto(PhotoInterface $photo);

    /**
     * @param Collection $photos
     */
    public function setPhotos(Collection $photos);

    /**
     * @return PhotoInterface[]
     */
    public function getPhotos();
}