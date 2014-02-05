<?php

namespace spec\FSi\Bundle\GalleryBundle\Doctrine;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use FSi\Bundle\GalleryBundle\Model\Gallery;
use PhpSpec\ObjectBehavior;

class GalleryManagerSpec extends ObjectBehavior
{
    function let(EntityRepository $entityRepository)
    {
        $this->beConstructedWith($entityRepository);
    }

    function is_is_gallery_manager()
    {
        $this->shouldBeAnInstanceOf('FSi\Bundle\GalleryBundle\Model\GalleryManagerInterface');
    }

    function it_return_gallery(EntityRepository $entityRepository, Gallery $gallery)
    {
        $entityRepository->findOneBy(array('id' => 1))->willReturn($gallery);
        $this->findGallery(1)->shouldReturn($gallery);
    }

    function it_return_pagerfanta_adapter(
        EntityRepository $entityRepository,
        QueryBuilder $queryBuilder
    ) {
        $entityRepository->createQueryBuilder('g')->willReturn($queryBuilder);
        $queryBuilder->where('g.visible = 1')->shouldBeCalled();

        $this->createPagerfantaAdapter()
            ->shouldReturnAnInstanceOf('Pagerfanta\Adapter\DoctrineORMAdapter');
    }
}
