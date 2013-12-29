<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Model;

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
     * @return PhotoInterface[]
     */
    public function getPhotos();
}