<?php

namespace ImageResize\Image\ImageType;

/**
 * Class Jpg
 * @package ImageResize\Image\ImageData
 */
class Jpg extends AbstractImage
{
    /**
     * @return resource
     */
    public function createImage()
    {
        return \imagecreatefromjpeg($this->filePath);
    }
}