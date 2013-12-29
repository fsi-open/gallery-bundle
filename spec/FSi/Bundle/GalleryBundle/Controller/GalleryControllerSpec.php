<?php

namespace spec\FSi\Bundle\GalleryBundle\Controller;

use FSi\Bundle\GalleryBundle\Model\Gallery;
use FSi\Bundle\GalleryBundle\Model\GalleryDataSourceBuilder;
use FSi\Bundle\GalleryBundle\Model\GalleryManagerInterface;
use FSi\Component\DataSource\DataSource;
use FSi\Component\DataSource\DataSourceView;
use PhpSpec\ObjectBehavior;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GalleryControllerSpec extends ObjectBehavior
{
    function let(
        EngineInterface $templating,
        GalleryDataSourceBuilder $dataSourceBuilder,
        GalleryManagerInterface $galleryManager
    ) {
        $this->beConstructedWith($templating, $dataSourceBuilder, $galleryManager, 4, 2);
    }

    function it_render_template_with_galleries_and_paginator(
        EngineInterface $templating,
        GalleryDataSourceBuilder $dataSourceBuilder,
        Response $response,
        DataSource $datasource,
        DataSourceView $dataSourceView
    ) {
        $dataSourceBuilder->buildDataSource()
            ->shouldBeCalled()
            ->willReturn($datasource);

        $datasource->setMaxResults(2)->shouldBeCalled();
        $datasource->setFirstResult(4)->shouldBeCalled();
        $datasource->createView()->shouldBeCalled()->willReturn($dataSourceView);
        $datasource->getResult()->shouldBeCalled()->willReturn(array('galleries'));

        $templating->renderResponse(
            'FSiGalleryBundle:Gallery:list.html.twig',
            array(
                'datasource' => $dataSourceView,
                'galleries' => array('galleries'),
                'preview_photos_count' => 4
            )
        )->shouldBeCalled()->willReturn($response);

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
        )->shouldBeCalled()->willReturn($response);

        $this->galleryAction(1)->shouldReturn($response);
    }
}
