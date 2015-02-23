# Templating

The base template for the gallery is very basic

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

and such, you will probably want to overwrite it. In order to do so, you need to 
create a twig template in ``app/Resources/FSiGalleryBundle/views/base.html.twig``
directory. Just remember to keep the ``fsi_gallery_content block``.

You can also overwrite the following templates to fine tune the bundle to your needs:

* ``app/Resources/FSiGalleryBundle/views/Gallery/gallery.html.twig``
* ``app/Resources/FSiGalleryBundle/views/Gallery/gallery_content.html.twig``
* ``app/Resources/FSiGalleryBundle/views/Gallery/list.html.twig``
* ``app/Resources/FSiGalleryBundle/views/Gallery/list_content.html.twig``
