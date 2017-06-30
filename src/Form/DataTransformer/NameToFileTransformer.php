<?php

namespace AppBundle\Form\DataTransformer;

use League\Flysystem\Filesystem;
use League\Glide\Server;
use Symfony\Component\Form\DataTransformerInterface;

class NameToFileTransformer implements DataTransformerInterface
{
    private $glide;
    private $storage;

    public function __construct(Server $glide, Filesystem $storage)
    {
        $this->glide = $glide;
        $this->storage = $storage;
    }

    public function transform($value)
    {
        $this->glide->outputImage();
        $this->storage->read('/TODO/'.$value);

        return $value;
    }

    public function reverseTransform($value)
    {
        return $value;
    }
}
