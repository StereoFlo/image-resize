<?php

namespace ImageResize\Image\ImageType;

/**
 * Class Png
 * @package ImageResize\Image\ImageData
 */
class Png extends AbstractImage
{
    /**
     * @return resource
     */
    public function createImage()
    {
        return \imagecreatefrompng($this->filePath);
    }

    /**
     * @param bool $toBrowser
     * @return bool
     */
    public function save($toBrowser = false)
    {
        if ($toBrowser) {
            $this->getHeader($this->getImageInfo()->getMimeType());
            imagepng($this->image, null, $this->compression);
        }
        return imagepng($this->image, $this->fileName, $this->compression);
    }
}