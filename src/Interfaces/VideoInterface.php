<?php

namespace Embryo\Interfaces;

interface VideoInterface
{
    /**
     * @param int $width
     */
    public function setWidth($width);

    /**
     * @return int
     */
    public function getWidth();

    /**
     * @param int $height
     */
    public function setHeight($height);

    /**
     * @return int
     */
    public function getHeight();

    /**
     * @param float $ratio
     */
    public function setRatio($ratio);

    /**
     * @return float
     */
    public function getRatio();
}