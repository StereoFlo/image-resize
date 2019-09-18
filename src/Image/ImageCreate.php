<?php

namespace ImageResize\Image;

use Exception;
use ImageResize\Exceptions\InvalidTypeException;
use ImageResize\Image\ImageType\AbstractImage;
use ImageResize\Image\ImageType\Gif;
use ImageResize\Image\ImageType\ImageInterface;
use ImageResize\Image\ImageType\Jpg;
use ImageResize\Image\ImageType\Png;
use ImageResize\Image\ImageType\Wbmp;

/**
 * Class ImageCreate
 * @package ImageResize\Image
 */
class ImageCreate
{
    /**
     * @param ImageInfo $imageInfo
     *
     * @return AbstractImage
     * @throws Exception
     */
    public static function create(ImageInfo $imageInfo)
    {
        return (new self())->load($imageInfo);
    }

    /**
     * Load an image resource
     *
     * @param ImageInfo $imageInfo
     * @return AbstractImage
     * @throws Exception
     */
    public function load(ImageInfo $imageInfo): ImageInterface
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
                throw new InvalidTypeException('image type is not supported');
        }
    }

    /**
     * @param AbstractImage $image
     * @return AbstractImage
     */
    private function createImage(AbstractImage $image): ImageInterface
    {
        return $image->createImage();
    }
}
