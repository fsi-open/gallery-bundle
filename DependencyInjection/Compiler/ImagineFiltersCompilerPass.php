<?php

namespace FSi\Bundle\GalleryBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ImagineFiltersCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('liip_imagine.filter_sets')) {
            throw new \RuntimeException("Remember to register LiipImagineBundle in you AppKernel.php");
        }

        $galleryFilters = array(
            'fsi_photo' => array(
                'quality' => 75,
                'filters' => array(
                    'thumbnail' => array(
                        'size' => array(
                            800,
                            600
                        ),
                        "mode" => "outbound"
                    ),
                ),
                "format" => null,
                "cache" => null,
                "data_loader" => null,
                "controller_action" => null,
                "route" => array()
            ),
            'fsi_photo_thumbnail' => array(
                'quality' => 75,
                'filters' => array(
                    'thumbnail' => array(
                        'size' => array(
                            200,
                            200
                        ),
                        "mode" => "outbound"
                    ),
                ),
                "format" => null,
                "cache" => null,
                "data_loader" => null,
                "controller_action" => null,
                "route" => array()
            )
        );

        $container->setParameter('liip_imagine.filter_sets', array_merge(
            $galleryFilters,
            $container->getParameter('liip_imagine.filter_sets')
        ));
    }
}
