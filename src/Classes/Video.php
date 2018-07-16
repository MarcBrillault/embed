<?php

namespace Embryo\Embed\Classes;

use Embryo\Embed\EmbedRoot;
use Embryo\Embed\Interfaces\VideoInterface;

abstract class Video extends EmbedRoot implements VideoInterface
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
     * @var float
     */
    protected $ratio;

    const DEFAULT_WIDTH = 400;
    const DEFAULT_RATIO = 16 / 9;

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        if ($this->width) {
            return $this->width;
        }
        if ($this->height) {
            return round($this->height * $this->getRatio());
        }

        return getenv('EMBED_WIDTH') ?: self::DEFAULT_WIDTH;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        if ($this->height) {
            return $this->height;
        }

        return round($this->getWidth() / $this->getRatio());
    }

    public function setRatio($ratio)
    {
        $this->ratio = $ratio;
    }

    /**
     * @return float
     */
    public function getRatio()
    {
        return $this->ratio ?: getenv('EMBED_RATIO') ?: self::DEFAULT_RATIO;
    }
}