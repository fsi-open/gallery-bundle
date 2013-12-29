<?php

namespace FSi\Bundle\GalleryBundle\Behat\Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class Gallery extends Page
{
    protected $path = '/gallery/{id}';

    public function getHeader()
    {
        return $this->find('css', 'h2.header');
    }

    public function getDescription()
    {
        return $this->find('css', 'p.description');
    }

    public function getThumbnails()
    {
        return $this->findAll('css', 'img.thumbnail');
    }
}