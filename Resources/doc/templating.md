# Templating

Base template for galleries list and gallery action is very primitive and in most cases
you will need to overwrite it.

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
</head>
    <body>
        <div>
            {% block fsi_gallery_content %}
            {% endblock fsi_gallery_content %}
        </div>
    </body>
</html>
```

It can be done by creating twig template in ``app/Resources/FSiGalleryBundle/views/base.html.twig``
Just remember to keep ``fsi_gallery_content block``

You can also overwrite following templates

* ``app/Resources/FSiGalleryBundle/views/Gallery/gallery.html.twig``
* ``app/Resources/FSiGalleryBundle/views/Gallery/gallery_content.html.twig``
* ``app/Resources/FSiGalleryBundle/views/Gallery/list.html.twig``
* ``app/Resources/FSiGalleryBundle/views/Gallery/list_content.html.twig``
