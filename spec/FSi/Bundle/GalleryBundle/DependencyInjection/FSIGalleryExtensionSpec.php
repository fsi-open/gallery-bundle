<?php

namespace spec\FSi\Bundle\GalleryBundle\DependencyInjection;

use PhpSpec\ObjectBehavior;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class FSIGalleryExtensionSpec extends ObjectBehavior
{
    function it_is_extension()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\DependencyInjection\Extension');
    }
}