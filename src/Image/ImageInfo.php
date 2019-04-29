<?php

namespace ImageResize\Image;

use Exception;
use function filesize;
use function getimagesize;

/**
 * Class ImageInfo
 * @package ImageResize\Image
 */
class ImageInfo
{
    /**
     * @var string
     */
    private $path = '';

    /**
     * All info by image
     * @var array
     */
    private $allInfo = [];

    /**
     * width of image
     * @var int
     */
    private $width = 0;

    /**
     * Height of image
     * @var int
     */
    private $height = 0;

    /**
     * type of image
     * @var int
     */
    private $type = 0;

    /**
     * html attributes
     * @var string
     */
    private $attributes = '';

    /**
     * @var int
     */
    private $bits = 0;

    /**
     * @var int
     */
    private $channels = 0;

    /**
     * mime type of image
     * @var string
     */
    private $mimeType = '';

    /**
     * @var int
     */
    private $fileSize = 0;

    /**
     * ImageInfo constructor.
     * @param string $filePath
     * @throws Exception
     */
    public function __construct(string $filePath)
    {
        $this->path = $filePath;
        $this->allInfo = $this->getInfo($filePath);
        list($this->width, $this->height, $this->type, $this->attributes) = $this->allInfo;
        if (isset($this->allInfo[4]) && !empty($this->allInfo[4])) {
            $this->bits = $this->allInfo[4];
        }
        if (isset($this->allInfo[5]) && !empty($this->allInfo[5])) {
            $this->channels = $this->allInfo[5];
        }
        if (isset($this->allInfo['mime']) && !empty($this->allInfo['mime'])) {
            $this->mimeType = $this->allInfo['mime'];
        }
        $this->fileSize = filesize($filePath);
    }

    /**
     * @return array
     */
    public function getAllInfo()
    {
        return $this->allInfo;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getAttributes(): string
    {
        return $this->attributes;
    }

    /**
     * @return int
     */
    public function getBits(): int
    {
        return $this->bits;
    }

    /**
     * @return int
     */
    public function getChannels(): int
    {
        return $this->channels;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * @param string $filePath
     * @return array
     * @throws Exception
     */
    protected function getInfo(string $filePath): array
    {
        $imageInfo = getimagesize($filePath);
        if (empty($imageInfo)) {
            throw new Exception('cannot read image info');
        }
        return $imageInfo;
    }
}
