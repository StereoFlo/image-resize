<?php

namespace ImageResize\Image\ImageType;

/**
 * Interface ImageInterface
 * @package ImageResize\Image\ImageType
 */
interface ImageInterface
{
    /**
     * @return self
     */
    public function createImage();

    /**
     * @param bool $toBrowser
     *
     * @return self
     */
    public function save($toBrowser = false);
}
