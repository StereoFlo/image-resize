<?php

namespace ImageResize\Image\ImageType;

use function imagecreatefromjpeg;
use function imagejpeg;

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
        $this->image = imagecreatefromjpeg($this->filePath);
        return $this;
    }

    /**
     * @param bool $toBrowser
     * @return bool
     */
    public function save($toBrowser = false)
    {
        if ($toBrowser) {
            $this->setConcreteHeaders();

            //return a cached image. do you think is not fight? fix it!
            if (empty($this->resizedImage)) {
                return imagejpeg($this->image);
            }
            return imagejpeg($this->resizedImage, null, $this->compression);
        }
        return imagejpeg($this->resizedImage, $this->fileName, $this->compression);
    }
}
