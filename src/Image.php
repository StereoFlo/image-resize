<?php

namespace ImageResize;

use ImageResize\Image\ImageInfo;
use ImageResize\Image\ImageCreate;
use ImageResize\Image\ImageResizer;
use ImageResize\Image\ImageSave;

/**
 * Class Image
 */
class Image
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
        $this->imageInfo = new ImageInfo($imagePath);
        $this->image = (new ImageCreate($this->imageInfo))->getImage();
        $this->resizer = new ImageResizer($this->image, $this->imageInfo);
        return $this;
    }

    /**
     * @param int $height
     * @return self
     */
    public function resizeToHeight(int $height): self
    {
        $this->image = $this->resizer->resizeToHeight($height)->getImage();
        return $this;
    }

    /**
     * @param int $width
     * @return Image
     */
    public function resizeToWidth(int $width): self
    {
        $this->image = $this->resizer->resizeToWidth($width)->getImage();
        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function resize(int $width, int $height): self
    {
        $this->image = $this->resizer->resize($width, $height)->getImage();
        return $this;
    }

    /**
     * @param int $scale
     * @return $this
     */
    public function resizeScale(int $scale): self
    {
        $this->image = $this->resizer->scale($scale)->getImage();
        return $this;
    }

    /**
     * @param string $filename
     * @param int $compression
     * @param int $permissions
     * @return bool
     * @throws \Exception
     */
    public function save(string $filename, int $compression = 75, int $permissions = 0): bool
    {
        return ImageSave::create($this->image, $this->imageInfo)->save($filename, $compression, $permissions);
    }

    /**
     * @param int $compression
     * @return bool
     * @throws \Exception
     */
    public function send(int $compression = 75)
    {
        return ImageSave::create($this->image, $this->imageInfo)->send($compression);
    }

    /**
     * @return ImageInfo
     */
    public function getImageInfo(): ImageInfo
    {
        return $this->imageInfo;
    }
}