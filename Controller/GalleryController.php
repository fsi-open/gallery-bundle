<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Controller;

use FSi\Bundle\GalleryBundle\Model\GalleryDataSourceBuilderInterface;
use FSi\Bundle\GalleryBundle\Model\GalleryManagerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class GalleryController
{
    /**
     * @var \FSi\Bundle\GalleryBundle\Model\GalleryManagerInterface
     */
    private $galleryManager;

    /**
     * @var GalleryDataSourceBuilderInterface
     */
    private $galleryDataSourceBuilder;

    /**
     * @var int
     */
    private $previewPhotosCount;

    /**
     * @var int
     */
    private $galleriesPerPage;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @param EngineInterface $templating
     * @param GalleryDataSourceBuilderInterface $galleryDataSourceBuilder
     * @param GalleryManagerInterface $galleryManager
     * @param $previewPhotosCount
     * @param $galleriesPerPage
     */
    function __construct(
        EngineInterface $templating,
        GalleryDataSourceBuilderInterface $galleryDataSourceBuilder,
        GalleryManagerInterface $galleryManager,
        $previewPhotosCount,
        $galleriesPerPage
    ) {
        $this->templating = $templating;
        $this->galleryDataSourceBuilder = $galleryDataSourceBuilder;
        $this->galleryManager = $galleryManager;
        $this->previewPhotosCount = $previewPhotosCount;
        $this->galleriesPerPage = $galleriesPerPage;
    }

    /**
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($page)
    {
        /* @var \FSi\Component\DataSource\DataSource $dataSource */
        $dataSource = $this->galleryDataSourceBuilder->buildDataSource();

        $dataSource->setMaxResults($this->galleriesPerPage);
        $dataSource->setFirstResult($page * $this->galleriesPerPage);

        return $this->templating->renderResponse(
            'FSiGalleryBundle:Gallery:list.html.twig',
            array(
                'datasource' => $dataSource->createView(),
                'galleries' => $dataSource->getResult(),
                'preview_photos_count' => $this->previewPhotosCount
            )
        );
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function galleryAction($id)
    {
        $gallery = $this->galleryManager->findGallery($id);

        return $this->templating->renderResponse(
            'FSiGalleryBundle:Gallery:gallery.html.twig',
            array(
                'gallery' => $gallery
            )
        );
    }
}