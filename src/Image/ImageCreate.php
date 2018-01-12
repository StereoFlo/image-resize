<?php

namespace ImageResize\Image;


use ImageResize\Image\ImageType\AbstractImage;
use ImageResize\Image\ImageType\Gif;
use ImageResize\Image\ImageType\Jpg;
use ImageResize\Image\ImageType\Png;

class ImageCreate
{
    /**
     * @var AbstractImage
     */
    private $image;

    public static function create(ImageInfo $imageInfo)
    {
        return (new self())->load($imageInfo);
    }

    /**
     * @param ImageInfo $imageInfo
     * @return AbstractImage
     */
    public function load(ImageInfo $imageInfo)
    {
        switch ($imageInfo->getType()) {
            case IMAGETYPE_JPEG:
                return $this->createImage(new Jpg($imageInfo->getPath(), $imageInfo));
            case IMAGETYPE_GIF:
                return $this->createImage(new Gif($imageInfo->getPath(), $imageInfo));
            case IMAGETYPE_PNG:
                return $this->createImage(new Png($imageInfo->getPath(), $imageInfo));
        }
    }

    /**
     * @param AbstractImage $image
     * @return AbstractImage
     */
    public function createImage(AbstractImage $image)
    {
        return $image->createImage();
    }

    /**
     * @return AbstractImage
     */
    public function getImage()
    {
        return $this->image;
    }
}