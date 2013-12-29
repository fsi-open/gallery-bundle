<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Doctrine;

use Doctrine\ORM\EntityRepository;
use FSi\Bundle\GalleryBundle\Model\GalleryDataSourceBuilder as BaseGalleryDataSourceBuilder;
use FSi\Component\DataSource\DataSourceFactoryInterface;

class GalleryDataSourceBuilder extends BaseGalleryDataSourceBuilder
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $galleryRepository;

    /**
     * @param DataSourceFactoryInterface $dataSourceFactory
     * @param EntityRepository $galleryRepository
     */
    function __construct(
        DataSourceFactoryInterface $dataSourceFactory,
        EntityRepository $galleryRepository
    ) {
        parent::__construct($dataSourceFactory);
        $this->galleryRepository = $galleryRepository;
    }

    /**
     * @return \FSi\Component\DataSource\DataSource
     */
    public function buildDataSource()
    {
        $qb = $this->galleryRepository->createQueryBuilder('gallery');
        $qb->andWhere('gallery.visible = 1');
        $datasource = $this->getDataSourceFactory()
            ->createDataSource(
                'doctrine',
                array(
                    'qb' => $qb
                ),
                'fsi_galleries'
            );

        return $datasource;
    }
}