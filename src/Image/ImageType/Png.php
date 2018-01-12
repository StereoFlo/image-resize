<?php

namespace ImageResize\Image\ImageType;

/**
 * Class Png
 * @package ImageResize\Image\ImageData
 */
class Png extends AbstractImage
{
    /**
     * @return resource
     */
    public function createImage()
    {
        return \imagecreatefrompng($this->filePath);
    }
}