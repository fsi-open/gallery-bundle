<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Model;

interface GalleryDataSourceBuilderInterface
{
    /**
     * @return \FSi\Component\DataSource\DataSourceFactoryInterface
     */
    public function getDataSourceFactory();

    /**
     * @return \FSi\Component\DataSource\DataSource
     */
    public function buildDataSource();
}