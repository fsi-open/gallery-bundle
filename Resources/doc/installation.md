# Installation in 5 simple steps

## 1. Download Gallery Bundle

Add to composer.json

```
"require": {
    "fsi/gallery-bundle": "dev-master"
}
```

## 2. Register bundles

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // Bundles required by FSiGalleryBundle
        new Liip\ImagineBundle\LiipImagineBundle(),
        new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
        new FSi\Bundle\DoctrineExtensionsBundle\FSiDoctrineExtensionsBundle(),
        new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),

        // FSiGalleryBundle
        new FSi\Bundle\GalleryBundle\FSiGalleryBundle(),
    );
}
```

## 3. Configure routing

```
# app/config/routing.yml

fsi_gallery:
    resource: "@FSiGalleryBundle/Resources/config/routing/gallery.yml"
    prefix: /

_imagine:
    resource: .
    type:     imagine
```

## 4. Create entities

```php
# /src/FSi/FixturesBundle/Entity/Gallery.php

<?php

namespace FSi\FixturesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\GalleryBundle\Model\Gallery as BaseGallery;

/**
 * @ORM\Entity
 * @ORM\Table(name="fsi_gallery")
 */
class Gallery extends BaseGallery
{
    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="gallery")
     */
    protected $photos;
}

```

```php

<?php
# /src/FSi/FixturesBundle/Entity/Photo.php

namespace FSi\FixturesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\GalleryBundle\Model\Photo as BasePhoto;

/**
 * @ORM\Entity
 * @ORM\Table(name="fsi_gallery_photo")
 */
class Photo extends BasePhoto
{
}
```
5. Configure application

```
# app/config/config.yml

fsi_doctrine_extensions: # You need to enable uploadable doctrine extension
    orm:
        default:
            uploadable: true

fsi_gallery:
    db_driver: orm
    gallery_class: FSi\FixturesBundle\Entity\Gallery
    photo_class: FSi\FixturesBundle\Entity\Photo
```

You are now ready to read about [templating](templating.md) gallery


