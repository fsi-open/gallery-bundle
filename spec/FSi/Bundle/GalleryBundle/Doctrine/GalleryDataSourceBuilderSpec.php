<?php

namespace spec\FSi\Bundle\GalleryBundle\Doctrine;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use FSi\Component\DataSource\DataSource;
use FSi\Component\DataSource\DataSourceFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GalleryDataSourceBuilderSpec extends ObjectBehavior
{
    function let(
        DataSourceFactory $dataSourceFactory,
        EntityRepository $er
    ) {
        $this->beConstructedWith($dataSourceFactory, $er);
    }

    function it_is_gallery_data_source_builder()
    {
        $this->shouldBeAnInstanceOf('FSi\Bundle\GalleryBundle\Model\GalleryDataSourceBuilderInterface');
    }

    function it_build_data_source(
        DataSourceFactory $dataSourceFactory,
        DataSource $dataSource,
        EntityRepository $er,
        QueryBuilder $qb
    ) {
        $er->createQueryBuilder('gallery')->shouldBeCalled()->willReturn($qb);
        $qb->andWhere('gallery.visible = 1')->shouldBeCalled();

        $dataSourceFactory->createDataSource(
            'doctrine',
            array(
                'qb' => $qb
            ),
            'fsi_galleries'
        )->shouldBeCalled()
        ->willReturn($dataSource);

        $this->buildDataSource()->shouldReturn($dataSource);
    }
}
