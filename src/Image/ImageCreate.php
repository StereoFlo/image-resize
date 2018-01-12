<?php

namespace ImageResize\Image;


use ImageResize\Image\ImageType\AbstractImage;
use ImageResize\Image\ImageType\Gif;
use ImageResize\Image\ImageType\Jpg;
use ImageResize\Image\ImageType\Png;

class ImageCreate
{
    /**
     * @var resource
     */
    private $image;

    /**
     * ImageCreate constructor.
     * @param ImageInfo $imageInfo
     */
    public function __construct(ImageInfo $imageInfo)
    {
        switch ($imageInfo->getType()) {
            case IMAGETYPE_JPEG:
                $this->image = $this->createImage(new Jpg($imageInfo->getPath()));
                break;
            case IMAGETYPE_GIF:
                $this->image = $this->createImage(new Gif($imageInfo->getPath()));
                break;
            case IMAGETYPE_PNG:
                $this->image = $this->createImage(new Png($imageInfo->getPath()));
                break;
        }
    }

    /**
     * @param AbstractImage $image
     * @return resource
     */
    public function createImage(AbstractImage $image)
    {
        return $image->createImage();
    }

    /**
     * @return resource
     */
    public function getImage()
    {
        return $this->image;
    }
}