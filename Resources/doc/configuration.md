# Configuration

Default bundle configuration values:

```
# app/config/config.yml

fsi_gallery:
    db_driver: orm
    gallery_class: # your gallery class, CAN'T BE EMPTY
    photo_class: # your gallery class, CANT' BE EMPTY
    preview_photos_count: 4 # thumbnails count at gallery list page (min. 1)
    galleries_per_page: 2 # galleries per page at gallery list page (min. 1)
```

For full configuration of the bundle check [official Symfony2 documentation](http://symfony.com/doc/master/bundles/LiipImagineBundle/configuration.html)
