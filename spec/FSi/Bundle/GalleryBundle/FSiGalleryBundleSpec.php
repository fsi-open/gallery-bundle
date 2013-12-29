<?php

namespace spec\FSi\Bundle\GalleryBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FSiGalleryBundleSpec extends ObjectBehavior
{
    function it_is_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    function it_have_custom_extension()
    {
        $this->getContainerExtension()
            ->shouldReturnAnInstanceOf('FSi\Bundle\GalleryBundle\DependencyInjection\FSIGalleryExtension');
    }

    function it_add_compiler_pass_during_build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            Argument::type(
                'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass'
            )
        )->shouldBeCalled();

        $container->addCompilerPass(
            Argument::type(
                'FSi\Bundle\GalleryBundle\DependencyInjection\Compiler\ImagineFiltersCompilerPass'
            )
        )->shouldBeCalled();

        $this->build($container);
    }
}
