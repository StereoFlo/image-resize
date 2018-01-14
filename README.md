English version is contained below.

# Image Resizer
Простой ресайзер изображенией. Позволяет изменять изображения JPG, GIF, PNG.

## Установка

```bash
composer require stereoflo/image-resize
```

## Использование

```php

$image = new \ImageResize\Image('pathToYouSourceImage');

```

или

```php

$image = \ImageResize\Image::create('pathToYouSourceImage');

```

Изменить размер и отправить изображение в браузер:

```php
$image->resize(400, 400)->send();
```


Изменить размер и сохраниеть в файловой системе:

```php
$image->resize(400, 400)->save('pathToNewFile');
```

# English version

Simple image resizer. It can work with such file types: JPG, GIF, PNG. 
It ready for use with Laravel 5.X

## How to install

```bash
composer require stereoflo/image-resize
```

## How to use 

```php

$image = new \ImageResize\Image('pathToYouSourceImage');

```

or you can make a static call

```php

$image = \ImageResize\Image::create('pathToYouSourceImage');

```

Change the size and send to a browser

```php
$image->resize(400, 400)->send();
```


Change the size and save in a file system:

```php
$image->resize(400, 400)->save('pathToNewFile');
```