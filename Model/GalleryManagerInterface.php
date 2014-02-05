<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Model;

interface GalleryManagerInterface
{
    /**
     * @param int $id
     * @return GalleryInterface
     */
    public function findGallery($id);

    /**
     * @return \Pagerfanta\Adapter\AdapterInterface
     */
    public function createPagerfantaAdapter();
}