<?php

namespace ImageResize\Image\ImageType;

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
        $this->image = \imagecreatefrompng($this->filePath);
        return $this;
    }

    /**
     * @param bool $toBrowser
     * @return bool
     */
    public function save($toBrowser = false):bool
    {
        if ($toBrowser) {
            $this->setHeader($this->getImageInfo()->getMimeType());
            if (empty($this->resizedImage)) {
                return \readfile($this->image, null, $this->compression);
            }
            return \imagepng($this->resizedImage, null, $this->compression);
        }
        return \imagepng($this->resizedImage, $this->fileName, $this->compression);
    }
}
