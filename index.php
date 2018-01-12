<?php
require 'vendor/autoload.php';

$image = new \ImageResize\Image('/Users/evgeniy/Downloads/8043e9cc62f419ab07a8bc73cbe27f65.jpg');
try {
    $image->resizeToWidth(700)->send(75);
} catch (Exception $exception) {
    print 'Was an error ' . $exception->getMessage();
}

//var_dump($image->getImageInfo());