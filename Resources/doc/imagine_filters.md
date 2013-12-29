# Image filters feature

This bundle use greate [LiipImagineBundle](https://github.com/liip/LiipImagineBundle) to
resize gallery photos.
By default there are 2 filters registered and used

``fsi_photo`` with following configuration

```php
array(
    'quality' => 75,
    'filters' => array(
        'thumbnail' => array(
            'size' => array(
                800,
                600
            ),
            "mode" => "outbound"
        ),
    ),
    "format" => null,
    "cache" => null,
    "data_loader" => null,
    "controller_action" => null,
    "route" => array()
),
```

``fsi_photo_thumbnail`` with following configuration

```php
array(
    'quality' => 75,
    'filters' => array(
        'thumbnail' => array(
            'size' => array(
                200,
                200
            ),
            "mode" => "outbound"
        ),
    ),
    "format" => null,
    "cache" => null,
    "data_loader" => null,
    "controller_action" => null,
    "route" => array()
),
```

Configuration of both filters can be overwritten in application config
Example:
```
# app/config/config.yml

liip_imagine:
    filter_sets:
        fsi_photo_thumbnail:
            quality: 100
            thumbnail: {size: [250, 250], mode: outbound}
        fsi_photo:
            quality: 100
            thumbnail: {size: [500, 500], mode: outbound}
```