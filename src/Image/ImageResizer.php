<?php

namespace ImageResize\Image;

/**
 * Class ImageResizer
 * @package ImageResize\Image
 */
class ImageResizer
{
    /**
     * @var resource
     */
    private $image;

    /**
     * @var ImageInfo
     */
    private $imageInfo;

    /**
     * ImageResizer constructor.
     * @param $image
     * @param ImageInfo $imageInfo
     */
    public function __construct($image, ImageInfo $imageInfo)
    {
        $this->image = $image;
        $this->imageInfo = $imageInfo;
    }

    /**
     * @param int $height
     * @return self
     */
    public function resizeToHeight(int $height): self
    {
        $ratio = $height / $this->imageInfo->getHeight();
        $width = $this->imageInfo->getWidth() * $ratio;
        return $this->resize($width, $height);
    }

    /**
     * @param int $width
     * @return self
     */
    public function resizeToWidth(int $width): self
    {
        $ratio = $width / $this->imageInfo->getWidth();
        $height = $this->imageInfo->getheight() * $ratio;
        return $this->resize($width, $height);
    }

    /**
     * @param int $scale
     * @return self
     */
    public function scale(int $scale): self
    {
        $width = $this->imageInfo->getWidth() * $scale / 100;
        $height = $this->imageInfo->getheight() * $scale / 100;
        return $this->resize($width, $height);
    }

    /**
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function resize(int $width, int $height): self
    {
        $newImage = \imagecreatetruecolor($width, $height);
        \imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $width, $height, $this->imageInfo->getWidth(), $this->imageInfo->getHeight());
        $this->image = $newImage;
        return $this;
    }

    /**
     * @return resource
     */
    public function getImage()
    {
        return $this->image;
    }
}