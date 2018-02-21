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
    public function createImage(): self
    {
        $this->image = \imagecreatefromgif($this->filePath);
        return $this;
    }

    /**
     * @param bool $toBrowser
     * @return bool
     */
    public function save($toBrowser = false): bool
    {
        if ($toBrowser) {
            $this->setHeader($this->getImageInfo()->getMimeType());
            if (empty($this->resizedImage)) {
                return \imagejpeg($this->image, null, $this->compression);
            }
            return \imagegif($this->resizedImage);
        }
        return imagegif($this->resizedImage, $this->fileName);
    }
}
