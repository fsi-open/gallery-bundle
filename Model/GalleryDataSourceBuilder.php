<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Model;

use FSi\Component\DataSource\DataSourceFactoryInterface;

abstract class GalleryDataSourceBuilder implements GalleryDataSourceBuilderInterface
{
    /**
     * @var \FSi\Component\DataSource\DataSourceFactoryInterface
     */
    private $dataSourceFactory;

    /**
     * @param DataSourceFactoryInterface $dataSourceFactory
     */
    function __construct(DataSourceFactoryInterface $dataSourceFactory)
    {
        $this->dataSourceFactory = $dataSourceFactory;
    }

    /**
     * @return DataSourceFactoryInterface
     */
    public function getDataSourceFactory()
    {
        return $this->dataSourceFactory;
    }
}