<?php

namespace Embryo\Embed\Interfaces;

interface VideoInterface
{
    public function setWidth(int $width);

    public function setHeight(int $height);

    public function setRatio(float $ratio);
}