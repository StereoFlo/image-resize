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
            $this->setHeader('Content-Type', $this->getImageInfo()->getMimeType());
            $this->setHeader('Content-Length', $this->getImageInfo()->getFileSize());

            //return a cached image. do you think is not fight? fix it!
            if (empty($this->resizedImage)) {
                return \imagewbmp($this->image);
            }
            return \imagewbmp($this->resizedImage);
        }
        return \imagewbmp($this->resizedImage, $this->fileName);
    }
}
