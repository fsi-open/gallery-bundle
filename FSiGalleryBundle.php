<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use FSi\Bundle\GalleryBundle\DependencyInjection\Compiler\ImagineFiltersCompilerPass;
use FSi\Bundle\GalleryBundle\DependencyInjection\FSIGalleryExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FSiGalleryBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver(
            $this->getDoctrineMappings(),
            array('doctrine.orm.entity_manager'))
        );
        $container->addCompilerPass(new ImagineFiltersCompilerPass());
    }

    /**
     * @return FSiGalleryExtension
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FSIGalleryExtension();
        }

        return $this->extension;
    }

    /**
     * @return array
     */
    private function getDoctrineMappings()
    {
        return array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'FSi\Bundle\GalleryBundle\Model',
        );
    }
}
