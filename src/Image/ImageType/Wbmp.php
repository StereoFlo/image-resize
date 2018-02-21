<?php

namespace ImageResize\Image\ImageType;

/**
 * Class Gif
 * @package ImageResize\Image\ImageData
 */
class Wbmp extends AbstractImage
{
    /**
     * @return self
     */
    public function createImage(): self
    {
        $this->image = \imagecreatefromwbmp($this->filePath);
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
                return \readfile($this->image, null, $this->compression);
            }
            return \imagewbmp($this->resizedImage);
        }
        return \imagewbmp($this->resizedImage, $this->fileName);
    }
}
