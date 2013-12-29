<?php

namespace FSi\Bundle\GalleryBundle\Behat\Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Exception\UnexpectedPageException;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class Galleries extends Page
{
    protected $path = '/galleries';

    /**
     * @param $galleryName
     * @return bool
     */
    public function hasGallery($galleryName)
    {
        return $this->has('css', sprintf('div.gallery > h2:contains("%s")', $galleryName));
    }

    /**
     * @param $galleryName
     * @return int
     */
    public function getGalleryThumbnailsCount($galleryName)
    {
        $gallery = $this->findGallery($galleryName);

        return count($gallery->findAll('css', 'img.thumbnail'));
    }

    /**
     * @param $galleryName
     * @return null|string
     */
    public function getGalleryDescription($galleryName)
    {
        $gallery = $this->findGallery($galleryName);

        return $gallery->find('css', 'p.description')->getText();
    }

    /**
     * @return array
     */
    public function getFirstGalleryPhotoThumbnail()
    {
        return $this->find('css', 'img.thumbnail');
    }

    /**
     * @return int
     */
    public function getGalleriesCount()
    {
        return count($this->findAll('css', 'div.gallery'));
    }

    /**
     * @return bool
     */
    public function hasPagination()
    {
        return $this->has('css', 'div.pagination > ul');
    }

    /**
     * @param $text
     * @return Boolean
     */
    public function hasPaginationButton($text)
    {
        return $this->hasLink($text);
    }

    /**
     * @param $text
     * @return Boolean
     */
    public function isButtonDisabled($text)
    {
        return $this->findLink($text)->getParent()->hasClass('disabled');
    }

    /**
     * @param $text
     * @return Boolean
     */
    public function isButtonActive($text)
    {
        return $this->findLink($text)->getParent()->hasClass('active');
    }

    /**
     * @param $galleryName
     * @return \Behat\Mink\Element\NodeElement|null
     * @throws \SensioLabs\Behat\PageObjectExtension\PageObject\Exception\UnexpectedPageException
     */
    private function findGallery($galleryName)
    {
        if (!$this->hasGallery($galleryName)) {
            throw new UnexpectedPageException(sprintf("Cant find gallery %s", $galleryName));
        }

        return $this->find('css', sprintf('div.gallery > h2:contains("%s")', $galleryName))
            ->getParent();
    }
}