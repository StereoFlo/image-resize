<?php

namespace ImageResize\Image\ImageType;

/**
 * Class Jpg
 * @package ImageResize\Image\ImageData
 */
class Jpg extends AbstractImage
{
    /**
     * @return self
     */
    public function createImage()
    {
        $this->image = \imagecreatefromjpeg($this->filePath);
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
            imagejpeg($this->image, null, $this->compression);
        }
        return imagejpeg($this->image, $this->fileName, $this->compression);
    }
}