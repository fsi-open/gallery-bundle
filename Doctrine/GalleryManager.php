<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Doctrine;

use Doctrine\ORM\EntityRepository;
use FSi\Bundle\GalleryBundle\Model\GalleryInterface;
use FSi\Bundle\GalleryBundle\Model\GalleryManagerInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class GalleryManager implements GalleryManagerInterface
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $entityRepository;

    /**
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    /**
     * @param int $id
     * @return GalleryInterface
     */
    public function findGallery($id)
    {
        return $this->entityRepository->findOneBy(array('id' => $id));
    }

    /**
     * @return \Pagerfanta\Adapter\AdapterInterface
     */
    public function createPagerfantaAdapter()
    {
        $queryBuilder = $this->entityRepository->createQueryBuilder('g')
            ->where('g.visible = 1');

        return new DoctrineORMAdapter($queryBuilder);
    }
}