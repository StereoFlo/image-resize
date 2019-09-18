<?php

namespace ImageResize\Image\ImageType;

use ImageResize\Exceptions\InvalidRangeException;
use function ceil;
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
     *
     * @return bool
     *
     * @throws InvalidRangeException
     */
    public function save($toBrowser = false):bool
    {
        $this->calcCompression();
        if ($toBrowser) {
            $this->setConcreteHeaders();

            //return a cached image. do you think is not fight? fix it!
            if (empty($this->resizedImage)) {
                return imagepng($this->image);
            }
            return imagepng($this->resizedImage, null, $this->compression);
        }
        return imagepng($this->resizedImage, $this->fileName, $this->compression);
    }

    /**
     * @throws InvalidRangeException
     */
    private function calcCompression(): void
    {
        if ($this->compression < -1) {
            throw new InvalidRangeException('compression for PNG type must be in range from 0 to 9. Default value is -1');
        }
        if ($this->compression > 9) {
            $this->compression = (int)ceil($this->compression / 10);
        }
    }
}
