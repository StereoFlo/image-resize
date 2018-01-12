<?php

namespace ImageResize\Image\ImageType;

/**
 * Class Gif
 * @package ImageResize\Image\ImageData
 */
class Gif extends AbstractImage
{
    /**
     * @return resource
     */
    public function createImage()
    {
        return \imagecreatefromgif($this->filePath);
    }
}