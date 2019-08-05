<?php

namespace ImageResize\Image;
use ImageResize\Image\ImageType\AbstractImage;
use function imagecopyresampled;
use function imagecreatetruecolor;

/**
 * Class ImageResizer
 * @package ImageResize\Image
 */
class ImageResizer
{
    /**
     * @var AbstractImage
     */
    private $image;

    /**
     * ImageResizer constructor.
     * @param AbstractImage $image
     */
    public function __construct(AbstractImage $image)
    {
        $this->image = $image;
    }

    /**
     * @param int $height
     * @return resource
     */
    public function resizeToHeight(int $height)
    {
        $ratio = $height / $this->image->getImageInfo()->getHeight();
        $width = $this->image->getImageInfo()->getWidth() * $ratio;
        return $this->resize($width, $height);
    }

    /**
     * @param int $width
     * @return resource
     */
    public function resizeToWidth(int $width)
    {
        $ratio = $width / $this->image->getImageInfo()->getWidth();
        $height = $this->image->getImageInfo()->getheight() * $ratio;
        return $this->resize($width, $height);
    }

    /**
     * @param int $scale
     * @return resource
     */
    public function scale(int $scale)
    {
        $width = $this->image->getImageInfo()->getWidth() * $scale / 100;
        $height = $this->image->getImageInfo()->getheight() * $scale / 100;
        return $this->resize($width, $height);
    }

    /**
     * @param int $width
     * @param int $height
     * @return resource
     */
    public function resize(int $width, int $height)
    {
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $this->image->getImage(), 0, 0, 0, 0, $width, $height, $this->image->getImageInfo()->getWidth(), $this->image->getImageInfo()->getHeight());
        return $newImage;
    }
}
