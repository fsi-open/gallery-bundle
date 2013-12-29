<?php

namespace spec\FSi\Bundle\GalleryBundle\Doctrine;

use Doctrine\ORM\EntityRepository;
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
        $entityRepository->findOneBy(array('id' => 1))->shouldBeCalled()->willReturn($gallery);
        $this->findGallery(1)->shouldReturn($gallery);
    }
}
