<?php

namespace ImageResize\Image\ImageType;

use function imagecreatefromgif;
use function imagegif;

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
        $this->image = imagecreatefromgif($this->filePath);
        return $this;
    }

    /**
     * @param bool $toBrowser
     * @return bool
     */
    public function save($toBrowser = false): bool
    {
        if ($toBrowser) {
            $this->setConcreteHeaders();

            //return a cached image. do you think is not fight? fix it!
            if (empty($this->resizedImage)) {
                return imagegif($this->image);
            }
            return imagegif($this->resizedImage);
        }
        return imagegif($this->resizedImage, $this->fileName);
    }
}
