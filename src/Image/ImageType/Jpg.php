<?php

namespace ImageResize\Image\ImageType;

/**
 * Class Jpg
 * @package ImageResize\Image\ImageData
 */
class Jpg extends AbstractImage
{
    /**
     * @return resource
     */
    public function createImage()
    {
        return \imagecreatefromjpeg($this->filePath);
    }

    /**
     * @param bool $toBrowser
     * @return mixed
     */
    public function save($toBrowser = false)
    {
        if ($toBrowser) {
            $this->getHeader($this->getImageInfo()->getMimeType());
            imagejpeg($this->image, null, $this->compression);
        }
        return imagejpeg($this->image, $this->fileName, $this->compression);
    }
}