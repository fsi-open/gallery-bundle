<?php

namespace spec\FSi\Bundle\GalleryBundle\Controller;

use FSi\Bundle\GalleryBundle\Model\Gallery;
use FSi\Bundle\GalleryBundle\Model\GalleryDataSourceBuilder;
use FSi\Bundle\GalleryBundle\Model\GalleryManagerInterface;
use FSi\Component\DataSource\DataSource;
use FSi\Component\DataSource\DataSourceView;
use Pagerfanta\Adapter\AdapterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GalleryControllerSpec extends ObjectBehavior
{
    function let(
        EngineInterface $templating,
        GalleryManagerInterface $galleryManager
    ) {
        $this->beConstructedWith($templating, $galleryManager, 4, 2);
    }

    function it_render_template_with_paginator(
        EngineInterface $templating,
        Response $response,
        GalleryManagerInterface $galleryManager,
        AdapterInterface $adapter
    ) {
        $galleryManager->createPagerfantaAdapter()->willReturn($adapter);
        $adapter->getNbResults()->willReturn(5);

        $templating->renderResponse(
            'FSiGalleryBundle:Gallery:list.html.twig',
            Argument::allOf(
                Argument::withEntry('galleries', Argument::type('Pagerfanta\Pagerfanta')),
                Argument::withEntry('preview_photos_count', 4)
            )
        )->willReturn($response);

        $this->listAction(2)->shouldReturn($response);
    }

    function it_render_template_with_gallery(
        EngineInterface $templating,
        GalleryManagerInterface $galleryManager,
        Gallery $gallery,
        Response $response
    ) {
        $galleryManager->findGallery(1)->shouldBeCalled()
            ->willReturn($gallery);

        $templating->renderResponse(
            'FSiGalleryBundle:Gallery:gallery.html.twig',
            array(
                'gallery' => $gallery,
            )
        )->willReturn($response);

        $this->galleryAction(1)->shouldReturn($response);
    }
}
