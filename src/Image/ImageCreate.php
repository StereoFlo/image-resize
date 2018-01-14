<?php

namespace ImageResize\Image;


use ImageResize\Image\ImageType\AbstractImage;
use ImageResize\Image\ImageType\Gif;
use ImageResize\Image\ImageType\Jpg;
use ImageResize\Image\ImageType\Png;
use ImageResize\Image\ImageType\Wbmp;

class ImageCreate
{
    /**
     * @param ImageInfo $imageInfo
     *
     * @return AbstractImage
     * @throws \Exception
     */
    public static function create(ImageInfo $imageInfo)
    {
        return (new self())->load($imageInfo);
    }

    /**
     * @param ImageInfo $imageInfo
     *
     * @return AbstractImage
     * @throws \Exception
     */
    public function load(ImageInfo $imageInfo)
    {
        switch ($imageInfo->getType()) {
            case IMAGETYPE_JPEG:
                return $this->createImage(new Jpg($imageInfo));
            case IMAGETYPE_GIF:
                return $this->createImage(new Gif($imageInfo));
            case IMAGETYPE_PNG:
                return $this->createImage(new Png($imageInfo));
            case IMAGETYPE_WBMP:
                return $this->createImage(new Wbmp($imageInfo));
            default:
                throw new \Exception('Image type is not supported');
        }
    }

    /**
     * @param AbstractImage $image
     * @return AbstractImage
     */
    private function createImage(AbstractImage $image)
    {
        return $image->createImage();
    }
}