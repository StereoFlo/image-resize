<?php

namespace ImageResize\Image\ImageType;

/**
 * Class Gif
 * @package ImageResize\Image\ImageData
 */
class Gif extends AbstractImage
{
    /**
     * @return self
     */
    public function createImage()
    {
        $this->image = \imagecreatefromgif($this->filePath);
        return $this;
    }

    /**
     * @param bool $toBrowser
     * @return mixed
     */
    public function save($toBrowser = false)
    {
        if ($toBrowser) {
            $this->getHeader($this->getImageInfo()->getMimeType());
            imagegif($this->image);
        }
        return imagegif($this->image, $this->fileName);
    }
}