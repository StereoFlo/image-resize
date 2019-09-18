<?php

namespace ImageResize\Image\ImageType;

use ImageResize\Exceptions\InvalidRangeException;
use function header;
use ImageResize\Image\ImageInfo;
use function in_array;
use function range;

/**
 * Class AbstractImage
 * @package ImageResize\Image\ImageType
 */
abstract class AbstractImage implements ImageInterface
{
    const CONTENT_TYPE = 'Content-Type';
    const CONTENT_LENGTH = 'Content-Length';

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
     * @var int
     */
    protected $compression = 0;

    /**
     * @var resource
     */
    protected $resizedImage;

    /**
     * AbstractImage constructor.
     *
     * @param ImageInfo $imageInfo
     */
    public function __construct(ImageInfo $imageInfo)
    {
        $this->filePath = $imageInfo->getPath();
        $this->imageInfo = $imageInfo;
    }

    /**
     * @return self
     */
    abstract public function createImage();

    /**
     * @param bool $toBrowser
     * @return bool
     */
    abstract public function save($toBrowser = false);

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
     * @param resource $resizedImage
     * @return self
     */
    public function setResizedImage($resizedImage): self
    {
        $this->resizedImage = $resizedImage;
        return $this;
    }

    /**
     * @param int $compression
     * @return self
     * @throws InvalidRangeException
     */
    public function setCompression(int $compression): self
    {
        if (!in_array($compression, range(1, 100))) {
            throw new InvalidRangeException('quality must be in range from 1 to 100');
        }

        $this->compression = $compression;

        return $this;
    }

    /**
     * @param string $key
     * @param string $val
     */
    protected function setHeader(string $key, string $val)
    {
        header($key . ': ' . $val);
    }

    /**
     * @return void
     */
    protected function setConcreteHeaders()
    {
        $this->setHeader(self::CONTENT_TYPE, $this->getImageInfo()->getMimeType());
        $this->setHeader(self::CONTENT_LENGTH, $this->getImageInfo()->getFileSize());
    }
}
