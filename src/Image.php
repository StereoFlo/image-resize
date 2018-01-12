<?php

namespace ImageResize;

use ImageResize\Image\ImageInfo;
use ImageResize\Image\ImageCreate;
use ImageResize\Image\ImageResizer;
use ImageResize\Image\ImageType\AbstractImage;

/**
 * Class Image
 */
class Image
{
    /**
     * @var AbstractImage
     */
    private $image;

    /**
     * @var ImageInfo
     */
    private $imageInfo;

    /**
     * @var ImageResizer
     */
    private $resizer;

    /**
     * Image constructor.
     * @param string $imagePath
     * @throws \Exception
     */
    public function __construct(string $imagePath)
    {
        if (!\file_exists($imagePath)) {
            throw new \Exception('specified file: ' . $imagePath . ' is not exist');
        }
        $this->image = (new ImageCreate(new ImageInfo($imagePath)));
        $this->resizer = new ImageResizer($this->image->getImage());
        return $this;
    }

    /**
     * @param int $height
     * @return self
     */
    public function resizeToHeight(int $height): self
    {
        $this->image->setResizedImage($this->resizer->resizeToHeight($height));
        return $this;
    }

    /**
     * @param int $width
     * @return Image
     */
    public function resizeToWidth(int $width): self
    {
        $this->image->setResizedImage($this->resizer->resizeToWidth($width));
        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function resize(int $width, int $height): self
    {
        $this->image->setResizedImage($this->resizer->resize($width, $height));
        return $this;
    }

    /**
     * @param int $scale
     * @return $this
     */
    public function resizeScale(int $scale): self
    {
        $this->image->setResizedImage($this->resizer->scale($scale));
        return $this;
    }

    /**
     * @param string $filename
     * @param int $compression
     * @return bool
     * @throws \Exception
     */
    public function save(string $filename, int $compression = 75): bool
    {
        return $this->image->setCompression($compression)->setFileName($filename)->save();
    }

    /**
     * @param int $compression
     * @return bool
     * @throws \Exception
     */
    public function send(int $compression = 75)
    {
        return $this->image->setCompression($compression)->save(true);
    }

    /**
     * @return ImageInfo
     */
    public function getImageInfo(): ImageInfo
    {
        return $this->imageInfo;
    }
}