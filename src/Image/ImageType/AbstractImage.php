<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 12.01.2018
 * Time: 15:31
 */

namespace ImageResize\Image\ImageType;


abstract class AbstractImage
{
    /**
     * @var string
     */
    protected $filePath = '';

    /**
     * AbstractImage constructor.
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return resource
     */
    abstract public function createImage();
}