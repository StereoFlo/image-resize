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
    public function createImage(): self
    {
        $this->image = \imagecreatefromjpeg($this->filePath);
        return $this;
    }

    /**
     * @param bool $toBrowser
     * @return bool
     */
    public function save($toBrowser = false)
    {
        if ($toBrowser) {
            $this->setHeader($this->getImageInfo()->getMimeType());
            return \imagejpeg($this->resizedImage, null, $this->compression);
        }
        return \imagejpeg($this->resizedImage, $this->fileName, $this->compression);
    }
}
