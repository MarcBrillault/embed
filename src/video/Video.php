<?php

namespace Embryo\Embed\Video;

use Embryo\Embed\Embed;
use Embryo\Embed\Interfaces\VideoInterface;

abstract class Video extends Embed implements VideoInterface
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $ratio;

    public function setWidth(int $width)
    {
        // TODO: Implement setWidth() method.
    }

    public function setHeight(int $height)
    {
        // TODO: Implement setHeight() method.
    }

    public function setRatio(float $ratio)
    {
        $this->ratio = $ratio;
    }
}