<?php

namespace ImageResize\Image\ImageType;

use function imagecreatefrompng;
use function imagepng;

/**
 * Class Png
 * @package ImageResize\Image\ImageData
 */
class Png extends AbstractImage
{
    /**
     * @return self
     */
    public function createImage(): self
    {
        $this->image = imagecreatefrompng($this->filePath);
        return $this;
    }

    /**
     * @param bool $toBrowser
     * @return bool
     */
    public function save($toBrowser = false):bool
    {
        if ($toBrowser) {
            $this->setHeader('Content-Type', $this->getImageInfo()->getMimeType());
            $this->setHeader('Content-Length', $this->getImageInfo()->getFileSize());

            //return a cached image. do you think is not fight? fix it!
            if (empty($this->resizedImage)) {
                return imagepng($this->image);
            }
            return imagepng($this->resizedImage, null, $this->compression);
        }
        return imagepng($this->resizedImage, $this->fileName, $this->compression);
    }
}
