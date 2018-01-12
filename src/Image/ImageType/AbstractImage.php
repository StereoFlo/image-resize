<?php

namespace ImageResize\Image\ImageType;

use ImageResize\Image\ImageInfo;

/**
 * Class AbstractImage
 * @package ImageResize\Image\ImageType
 */
abstract class AbstractImage
{
    /**
     * @var string
     */
    protected $filePath = '';

    /**
     * @var resource
     */
    protected $image;

    /**
     * @var
     */
    protected $imageInfo;

    /**
     * @var string
     */
    protected $fileName;

    /**
    protected $compression = 0;

    /**
     * @var resource
     */
    protected $resizedImage;

    /**
     * AbstractImage constructor.
     * @param string $filePath
     * @param ImageInfo $imageInfo
     */
    public function __construct(string $filePath, ImageInfo $imageInfo)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return self
     */
    abstract public function createImage();

    /**
     * @param bool $toBrowser
     * @return mixed
     */
    abstract public function save($toBrowser = false);

    public function getHeader(string $mimeType)
    {
        header('Content-Type: ' . $mimeType);
    }

    /**
     * @param string $fileName
     * @return AbstractImage
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return ImageInfo
     */
    public function getImageInfo()
    {
        return $this->imageInfo;
    }

    /**
     * @return resource
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param resource $image
     * @return AbstractImage
     */
    public function setImage($image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @param resource $resizedImage
     * @return AbstractImage
     */
    public function setResizedImage(resource $resizedImage): AbstractImage
    {
        $this->resizedImage = $resizedImage;
        return $this;
    }

    /**
     * @return resource
     */
    public function getResizedImage(): resource
    {
        return $this->resizedImage;
    }
}