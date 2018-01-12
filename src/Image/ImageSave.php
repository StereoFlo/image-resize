<?php

namespace ImageResize\Image;


class ImageSave
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
     * @param $image
     * @param ImageInfo $imageInfo
     * @return ImageSave
     */
    public static function create($image, ImageInfo $imageInfo): self
    {
        return new self($image, $imageInfo);
    }

    /**
     * ImageSave constructor.
     * @param $image
     * @param ImageInfo $imageInfo
     */
    public function __construct($image, ImageInfo $imageInfo)
    {
        $this->image = $image;
        $this->imageInfo = $imageInfo;
    }

    /**
     * @param string $filename path for save a new file
     * @param int $compression
     * @param int $permissions
     * @return bool
     * @throws \Exception
     */
    public function save(string $filename, int $compression = 75, int $permissions = 0): bool
    {
        switch ($this->imageInfo->getType()) {
            case IMAGETYPE_JPEG:
                imagejpeg($this->image, $filename, $compression);
                break;
            case IMAGETYPE_GIF:
                imagegif($this->image, $filename);
                break;
            case IMAGETYPE_PNG:
                imagepng($this->image, $filename);
                break;
            default:
                throw new \Exception('Unknown file type');
        }

        if (empty($permissions)) {
            return true;
        }
        return chmod($filename, $permissions);
    }

    /**
     * @param int $compression
     * @return bool
     * @throws \Exception
     */
    public function send(int $compression = 75)
    {
        switch ($this->imageInfo->getType()) {
            case IMAGETYPE_JPEG:
                $this->getHeader($this->imageInfo->getMimeType());
                return imagejpeg($this->image, null, $compression);
            case IMAGETYPE_GIF:
                $this->getHeader($this->imageInfo->getMimeType());
                return imagegif($this->image, null);
            case IMAGETYPE_PNG:
                $this->getHeader($this->imageInfo->getMimeType());
                return imagepng($this->image, null, $compression);
            default:
                throw new \Exception('Unknown file type');
        }
    }

    /**
     * Sets an header for browser
     *
     * @param string $mime
     */
    private function getHeader(string $mime)
    {
        header('Content-Type: ' . $mime);
    }
}