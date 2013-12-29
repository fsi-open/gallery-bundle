<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Model;

interface PhotoInterface
{
    /**
     * @param \FSi\Bundle\GalleryBundle\Model\GalleryInterface $gallery
     */
    public function setGallery(GalleryInterface $gallery);
}